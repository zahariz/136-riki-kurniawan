<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use App\Models\TransactionDetail;
use App\Models\WarehouseManagement;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(): View
    {
        $emptyBinTotal = StorageBin::query()->whereDoesntHave('warehouse')->count();
        $filledBinTotal = StorageBin::query()->whereHas('warehouse')->count();
        $productTotal = Product::query()->count();
        $locationTotal = StorageLocation::query()->count();
        $transaksi = TransactionDetail::query()
        ->with(['transaction', 'product', 'sloc', 'sbin'])
        ->limit(5)
        ->latest()
        ->get();

        $sumIn = TransactionDetail::query()
                ->selectRaw('DATE(created_at) as date, SUM(qty) as total_qty')
                ->with(['transaction', 'product', 'sloc', 'sbin'])
                ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                ->whereHas('transaction' , function ($query) {
                    $query->where('transaction_type', '=', 'IN');
                })
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        $sumOut = TransactionDetail::query()
                    ->selectRaw('DATE(created_at) as date, SUM(qty) as total_qty')
                    ->with(['transaction', 'product', 'sloc', 'sbin'])
                    ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                    ->whereHas('transaction' , function ($query) {
                        $query->where('transaction_type', '=', 'OUT');
                    })
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

        $countNewProducts = Product::query()
                    ->selectRaw('DATE(created_at) as date, COUNT(*) as total_qty')
                    ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
        $countNewLocations = StorageLocation::query()
                    ->selectRaw('DATE(created_at) as date, COUNT(*) as total_qty')
                    ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

        return view('Dashboard.index', [
            'title' => 'Analytical Dashboard',
            'emptyBinTotal' => $emptyBinTotal,
            'filledBinTotal' => $filledBinTotal,
            'productTotal' => $productTotal,
            'locationTotal' => $locationTotal,
            'data' => $transaksi,
            'sumIn' => $sumIn,
            'sumOut' => $sumOut,
            'countNewProducts' => $countNewProducts,
            'countNewLocations' => $countNewLocations
        ]);
    }
}
