<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use App\Models\TransactionDetail;
use App\Models\WarehouseManagement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WarehouseManagementController extends Controller
{
    public function stock(): View
    {
        $products = Product::query()->get();
        $locations = StorageLocation::query()->get();
        $storageBins = StorageBin::query()->get();
        return view('Warehouse.StockReport.create', [
            'title' => 'Filter Stock Report',
            'products' => $products,
            'sbin' => $storageBins,
            'sloc' => $locations
        ]);
    }

    public function filter(Request $request): View | RedirectResponse
    {
        // dd($request->all());
        $product = $request->input('product');
        $batch = $request->input('batch');
        $sloc = $request->input('sloc');
        $sbin = $request->input('sbin');
        $data = WarehouseManagement::query()->with(['product', 'sloc', 'sbin'])
                ->when($product, function ($query, $product) {
                    return $query->where('product_id', $product);
                })
                ->when($batch, function ($query, $batch) {
                    return $query->where('batch', $batch);
                })
                ->when($sloc, function ($query, $sloc) {
                    return $query->where('sloc_id', $sloc);
                })
                ->when($sbin, function ($query, $sbin) {
                    return $query->where('sbin_id', $sbin);
                })
                ->paginate(10);
        if($data->isEmpty()) {
            return redirect()->route('warehouse.stock-report')->with('error', 'Data tidak ditemukan!');
        }
        return view('Warehouse.StockReport.index', [
            'data' => $data,
            'title' => 'Stock Report'
        ]);
    }

    public function history(Request $request): View
    {
        $search = $request->input('search');
        $search === null ?
        $data = TransactionDetail::query()
                    ->with(['transaction', 'product', 'sloc', 'sbin'])
                    ->paginate(10) :
        $data = TransactionDetail::query()
                    ->with(['transaction', 'product', 'sloc', 'sbin'])
                    ->where('batch', 'like', '%'. $search . '%')
                    ->orWhereHas('transaction', function($query) use ($search) {
                        $query->where('transaction_code', 'like', '%'. $search . '%');
                        $query->orWhere('transaction_type', 'like', '%'. $search . '%');
                    })
                    ->orWhereHas('product', function ($query) use($search) {
                        $query->where('product_name', 'like', '%'. $search . '%');
                    })
                    ->orWhereHas('sbin', function ($query) use ($search) {
                        $query->where('kode_bin', 'like', '%'. $search . '%');
                    })
                    ->orWhereHas('sloc', function ($query) use ($search) {
                        $query->where('nama_sloc', 'like', '%'. $search . '%');
                    })
                    ->paginate(10);
        // dd($data);
        return view('Warehouse.History.index', [
            'title' => 'Transaction History',
            'data' => $data
        ]);
    }
}
