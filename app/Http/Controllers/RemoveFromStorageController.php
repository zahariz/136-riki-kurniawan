<?php

namespace App\Http\Controllers;

use App\Http\Requests\RMFSessionStoreRequest;
use App\Http\Requests\RMFSessionUpdateRequest;
use App\Http\Requests\RMFStoreRequest;
use App\Http\Requests\RMFUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RemoveFromStorageController extends Controller
{
    public function index(): View
    {
        // Mengambil data dari session
        $generatedData = session('sessionRemoveFromStorage', []);
        return view('warehouse.RemoveFromStorage.index', [
            'title' => 'Remove From Storage',
            'sessionRemoveFromStorage' => $generatedData
        ]);
    }

    public function store(RMFStoreRequest $request)
    {
        $data = $request->validated();
        if(!$data) {
            return redirect()->back()->with('error', 'Form tidak boleh kosong!');
        }
        $result = [];
        foreach ($data['product'] as $key => $value) {
            $result[] = [
                'product' => $data['product'][$key],
                'batch' => $data['batch'][$key],
                'sloc' => $data['sloc'][$key],
                'sbin' => $data['sbin'][$key],
                'qty' => $data['qty'][$key],
            ];
        }

        return response()->json([
            'data' => $result
        ]);
    }
    public function sessionStore(RMFSessionStoreRequest $request): RedirectResponse
    {

        $data = $request->validated();
        $uuid = Str::random(5);
        // Menyimpan data ke dalam session
        Session::push('sessionRemoveFromStorage', [
            'uuid' => $uuid,
            'product' => $data['product'],
            'batch' => $data['batch'],
            'sloc' => $data['sloc'],
            'sbin' => $data['sbin'],
            'qty' => $data['qty'],
        ]);

        return redirect()->route('warehouse.remove-from-storage')->with('status', 'Cart successfully added!');
    }

    public function sessionUpdate(RMFSessionUpdateRequest $request)
    {
        $data = $request->validated();
        $uuid = $request->input('e_uuid');
        $generatedData = session('sessionRemoveFromStorage');
        $updatedData = [
            'uuid' => $uuid,
            'product' => $data['e_product'],
            'batch' => $data['e_batch'],
            'sloc' => $data['e_sloc'],
            'sbin' => $data['e_sbin'],
            'qty' => $data['e_qty']
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
        $uuidToDelete = $request->input('e_uuid');

        foreach ($generatedData as $key => $data) {
            if ($data['uuid'] === $uuidToDelete) {
                unset($generatedData[$key]);
            }
        }

        session(['sessionRemoveFromStorage' => $generatedData]);

        return redirect()->route('warehouse.remove-from-storage')->with('status', 'Cart deleted!');

    }



}
