<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceivingSessionStoreRequest;
use App\Http\Requests\ReceivingSessionUpdateRequest;
use App\Http\Requests\ReceivingStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ReceivingController extends Controller
{
    public function index()
    {
        $generatedData = session('sessionReceiving', []);
        return view('warehouse.Receiving.index', [
            'title' => 'Receiving',
            'sessionReceiving' => $generatedData
        ]);
    }

    public function store(ReceivingStoreRequest $request) : RedirectResponse | JsonResponse
    {
        $data = $request->validated();
        if(!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $result = [];

        foreach($data['product'] as $key => $value)
        {
            $result[] = [
                'product' => $value,
                'batch' => $data['batch'][$key],
                'sloc' => $data['sloc'][$key],
                'sbin' => $data['sbin'][$key],
                'qty' => $data['qty'][$key],
                'prod_date' => $data['prod_date'][$key],
                'exp_date' => $data['exp_date'][$key],
            ];
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function sessionStore(ReceivingSessionStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if(!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $uuid = Str::random(5);
        // Menyimpan data ke dalam session
        Session::push('sessionReceiving', [
            'uuid' => $uuid,
            'product' => $data['product'],
            'batch' => $data['batch'],
            'sloc' => $data['sloc'],
            'sbin' => $data['sbin'],
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
            'product' => $data['e_product'],
            'batch' => $data['e_batch'],
            'sloc' => $data['e_sloc'],
            'sbin' => $data['e_sbin'],
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
