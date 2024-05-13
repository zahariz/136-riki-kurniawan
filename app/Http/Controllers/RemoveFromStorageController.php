<?php

namespace App\Http\Controllers;

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
    public function generateSession(Request $request): RedirectResponse
    {
        $product = $request->input('product');
        $batch = $request->input('batch');
        $sloc = $request->input('sloc');
        $sbin = $request->input('sbin');
        $qty = $request->input('qty');

        $uuid = Str::random(5);
        // Menyimpan data ke dalam session
        Session::push('sessionRemoveFromStorage', [
            'uuid' => $uuid,
            'product' => $product,
            'batch' => $batch,
            'sloc' => $sloc,
            'sbin' => $sbin,
            'qty' => $qty,
        ]);

        return redirect()->route('warehouse.remove-from-storage');
    }

    public function sessionUpdate(Request $request)
    {
        $generatedData = session('sessionRemoveFromStorage');
        $updatedData = [
            'uuid' => $request->input('e_uuid'),
            'product' => $request->input('e_product'),
            'batch' => $request->input('e_batch'),
            'sloc' => $request->input('e_sloc'),
            'sbin' => $request->input('e_sbin'),
            'qty' => $request->input('e_qty')
        ];

        foreach ($generatedData as $key => $data) {
            // Jika data sesuai dengan kriteria 'where product', perbarui data
            if ($data['uuid'] === $request->input('e_uuid')) {
                $generatedData[$key] = $updatedData;
            }
        }

        // Menyimpan kembali data ke dalam session
        session(['sessionRemoveFromStorage' => $generatedData]);

        return redirect()->route('warehouse.remove-from-storage');


    }



}
