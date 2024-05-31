<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceivingSessionStoreRequest;
use App\Http\Requests\ReceivingSessionUpdateRequest;
use App\Http\Requests\ReceivingStoreRequest;
use App\Models\Product;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\WarehouseManagement;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ReceivingController extends Controller
{
    public function index()
    {
        $generatedData = session('sessionReceiving', []);
        $product = Product::all();
        $sloc = StorageLocation::all();
        $sbin = StorageBin::query()->with('sloc')->get();

        return view('warehouse.Receiving.index', [
            'title' => 'Receiving',
            'sessionReceiving' => $generatedData,
            'products' => $product,
            'sloc' => $sloc,
            'sbin' => $sbin
        ]);
    }

    private function generateTransactionCode(): string
    {
        $currentDate = Carbon::now()->format('ymd');
        $lastTransaction = Transaction::whereDate('created_at', Carbon::today())
                                    ->orderBy('id', 'desc')
                                    ->first();

        if ($lastTransaction) {
            $lastReferenceCode = $lastTransaction->transaction_code;
            $lastSequence = (int) substr($lastReferenceCode, -4);
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }
        return 'T-' . $currentDate . '-' . str_pad($newSequence, 4, '0', STR_PAD_LEFT);
    }

    public function store(ReceivingStoreRequest $request): RedirectResponse | JsonResponse
    {
        $data = $request->validated();
        if (!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $transactionCode = $this->generateTransactionCode();
        $transactionType = 'IN';
        try {
            DB::beginTransaction();

            $transaction = Transaction::query()->create([
                'transaction_code' => $transactionCode,
                'transaction_type' => $transactionType,
                'user_id' => Auth::user()->id
            ]);

            foreach ($data['product_id'] as $key => $productId) {
                $batch = $data['batch'][$key];
                $qty = $data['qty'][$key];
                $expDate = Carbon::createFromFormat('d/m/Y', $data['exp_date'][$key])->format('Y-m-d');
                $prodDate = Carbon::createFromFormat('d/m/Y', $data['prod_date'][$key])->format('Y-m-d');
                $sbinId = $data['sbin_id'][$key];
                $slocId = $data['sloc_id'][$key];

                TransactionDetail::query()->create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'batch' => $batch,
                    'qty' => $qty,
                    'exp_date' => $expDate,
                    'prod_date' => $prodDate,
                    'sbin_id' => $sbinId,
                    'sloc_id' => $slocId
                ]);

                WarehouseManagement::query()->updateOrCreate(
                    [
                        'product_id' => $productId,
                        'batch' => $batch,
                        'sbin_id' => $sbinId,
                        'sloc_id' => $slocId
                    ],
                    [
                        'qty' => DB::raw("qty + $qty"),
                        'exp_date' => $expDate,
                        'prod_date' => $prodDate
                    ]
                );
            }

            DB::commit();
            session()->forget('sessionReceiving');
            return redirect()->route('warehouse.receiving.print',$transaction->id)->with('status', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong : ' . $e->getMessage());
        }

    }

    public function print(int $id)
    {
        $transaction = TransactionDetail::query()->with(['transaction', 'product', 'sbin', 'sloc'])->where('transaction_id', $id)->get();
        // dd($transaction);
        $user = Transaction::query()->with('user')
                                    ->where('id', $id)
                                    ->get();
        Carbon::setLocale('id');
        return view('Warehouse.Receiving.print', [
            'data' => $transaction,
            'user' => $user,
            'title' => 'Print Receiving'
        ]);
    }


    public function sessionStore(ReceivingSessionStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $uuid = Str::random(5);
        // Menyimpan data ke dalam session
        Session::push('sessionReceiving', [
            'uuid' => $uuid,
            'product_name' => $request->input('product_name'),
            'product_id' => $request->input('product_id'),
            'batch' => $data['batch'],
            'nama_sloc' => $request->input('nama_sloc'),
            'sloc_id' => $request->input('sloc_id'),
            'kode_bin' => $request->input('kode_bin'),
            'sbin_id' => $request->input('sbin_id'),
            'qty' => $data['qty'],
            'prod_date' => $data['prod_date'],
            'exp_date' => $data['exp_date'],
        ]);

        return redirect()->route('warehouse.receiving')->with('status', 'Cart successfully added!');
    }

    public function sessionUpdate(ReceivingSessionUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $uuid = $request->input('e_uuid');
        $generatedData = session('sessionReceiving');
        $updatedData = [
            'uuid' => $uuid,
            'product_id' => $request->input('e_product_id'),
            'product_name' => $request->input('e_product_name'),
            'batch' => $data['e_batch'],
            'sloc_id' => $request->input('e_sloc_id'),
            'nama_sloc' => $request->input('e_nama_sloc'),
            'sbin_id' => $request->input('e_sbin_id'),
            'kode_bin' => $request->input('e_kode_bin'),
            'qty' => $data['e_qty'],
            'prod_date' => $data['e_prod_date'],
            'exp_date' => $data['e_exp_date'],
        ];

        foreach ($generatedData as $key => $data) {
            if ($data['uuid'] === $uuid) {
                $generatedData[$key] = $updatedData;
            }
        }

        session(['sessionReceiving' => $generatedData]);

        return redirect()->route('warehouse.receiving')->with('status', 'Cart successfully added!');
    }
    public function sessionDestroy(Request $request)
    {
        $generatedData = session('sessionReceiving');
        $uuidToDelete = $request->input('e_uuid');

        foreach ($generatedData as $key => $data) {
            if ($data['uuid'] === $uuidToDelete) {
                unset($generatedData[$key]);
            }
        }

        session(['sessionReceiving' => $generatedData]);

        return redirect()->route('warehouse.receiving')->with('status', 'Cart deleted!');
    }
}
