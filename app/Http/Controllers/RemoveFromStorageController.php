<?php

namespace App\Http\Controllers;

use App\Http\Requests\RMFSessionStoreRequest;
use App\Http\Requests\RMFSessionUpdateRequest;
use App\Http\Requests\RMFStoreRequest;
use App\Http\Requests\RMFUpdateRequest;
use App\Models\Product;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\WarehouseManagement;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RemoveFromStorageController extends Controller
{
    public function index(): View
    {
        // Mengambil data dari session
        $generatedData = session('sessionRemoveFromStorage', []);
        // dd($generatedData);
        $products = WarehouseManagement::with(['product', 'sloc', 'sbin'])->get();
        $sloc = StorageLocation::query()->get();
        $sbin = StorageBin::query()->get();
        return view('warehouse.RemoveFromStorage.index', [
            'title' => 'Remove From Storage',
            'sessionRemoveFromStorage' => $generatedData,
            'products' => $products,
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

    public function store(RMFStoreRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if (!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $generatedData = session('sessionRemoveFromStorage', []);
        $inputIds = $request->input('id');
        $inputQuantities = $data['qty'];

        // Retrieve all WarehouseManagement records in one query
        $warehouseItems = WarehouseManagement::whereIn('id', $inputIds)->get()->keyBy('id');
        $transactionCode = $this->generateTransactionCode();
        $transactionType = 'OUT';

        DB::beginTransaction();
        try {
            $transaction = Transaction::query()->create([
                'transaction_code' => $transactionCode,
                'transaction_type' => $transactionType,
                'user_id' => 1
            ]);
            foreach ($inputIds as $key => $value) {
                $wm = $warehouseItems->get($value);
                $qty = intval($inputQuantities[$key]);

                if (!$wm) {
                    return redirect()->back()->with('error', 'Item not found in the warehouse.');
                }
                $productId = $data['product_id'][$key];
                $batch = $data['batch'][$key];
                $qty = $data['qty'][$key];
                $expDate = $data['exp_date'][$key];
                $prodDate = $data['prod_date'][$key];
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

                if ($qty < $wm->qty) {
                    $wm->qty -= $qty;
                    $wm->save();
                } elseif ($qty == $wm->qty) {
                    $wm->delete();
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Qty tidak boleh melebihi stock!');
                }

                unset($generatedData[$key]);
            }

            session(['sessionRemoveFromStorage' => $generatedData]);
            DB::commit();

            return redirect()->route('warehouse.remove-from-storage.print', $transaction->id)->with('status', 'Data berhasil dihapus dari storage!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong.' . $e->getMessage());
        }
    }
    public function sessionStore(RMFSessionStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $uuid = Str::random(5);
        Session::push('sessionRemoveFromStorage', [
            'uuid' => $uuid,
            'id' => $request->input('id'),
            'product_name' => $request->input('product_name'),
            'product_id' => $request->input('product_id'),
            'batch' => $data['batch'],
            'exp_date' => $data['exp_date'],
            'prod_date' => $data['prod_date'],
            'nama_sloc' => $request->input('nama_sloc'),
            'sloc_id' => $request->input('sloc_id'),
            'kode_bin' => $request->input('kode_bin'),
            'sbin_id' => $request->input('sbin_id'),
            'qty' => $data['qty'],
        ]);

        return redirect()->route('warehouse.remove-from-storage')->with('status', 'Cart successfully added!');
    }

    public function print(int $id): View
    {
        $transaction = TransactionDetail::query()->with(['transaction', 'product', 'sbin', 'sloc'])->where('transaction_id', $id)->get();
        // dd($transaction);
        // Carbon::setLocale('id');
        return view('Warehouse.RemoveFromStorage.print', [
            'data' => $transaction,
            'title' => 'Print Remove From Storage'
        ]);
    }

    public function sessionUpdate(RMFSessionUpdateRequest $request)
    {
        $data = $request->validated();
        $uuid = $request->input('uuid');
        $generatedData = session('sessionRemoveFromStorage');
        $updatedData = [
            'uuid' => $uuid,
            'id' => $request->input('id'),
            'product_name' => $request->input('product_name'),
            'product_id' => $request->input('product_id'),
            'batch' => $data['batch'],
            'exp_date' => $data['exp_date'],
            'prod_date' => $data['prod_date'],
            'nama_sloc' => $request->input('nama_sloc'),
            'sloc_id' => $request->input('sloc_id'),
            'kode_bin' => $request->input('kode_bin'),
            'sbin_id' => $request->input('sbin_id'),
            'qty' => $data['qty'],
        ];

        foreach ($generatedData as $key => $datas) {
            if ($datas['uuid'] == $uuid) {
                $generatedData[$key] = $updatedData;
            }
        }

        session(['sessionRemoveFromStorage' => $generatedData]);

        return redirect()->route('warehouse.remove-from-storage')->with('status', 'Cart updated!');


    }

    public function sessionDestroy(Request $request)
    {
        $generatedData = session('sessionRemoveFromStorage');
        $uuidToDelete = $request->input('uuid');

        foreach ($generatedData as $key => $data) {
            if ($data['uuid'] === $uuidToDelete) {
                unset($generatedData[$key]);
            }
        }

        session(['sessionRemoveFromStorage' => $generatedData]);

        return redirect()->route('warehouse.remove-from-storage')->with('status', 'Cart deleted!');

    }



}
