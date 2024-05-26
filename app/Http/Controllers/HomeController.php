<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use App\Models\WarehouseManagement;
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
        return view('Dashboard.index', [
            'title' => 'Analytical Dashboard',
            'emptyBinTotal' => $emptyBinTotal,
            'filledBinTotal' => $filledBinTotal,
            'productTotal' => $productTotal,
            'locationTotal' => $locationTotal,
        ]);
    }
}
