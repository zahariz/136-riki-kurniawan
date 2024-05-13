<?php

use App\Http\Controllers\RemoveFromStorageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::get('/home', function () {
    return view('Dashboard.index');
})->name('dashboard');

// Route Category
Route::get('/category', function () {
    $data = [
        [
        'id' => 1,
        'category_name' => 'Product Alergen',
        'description' => 'Product alergen seperti susu, kacang dan lain sebagainya.'
        ],
        [
            'id' => 2,
            'category_name' => 'Product Sukrosa',
            'description' => 'Produck sukrosa seperti gula, glukosa'
        ]
    ];
    return view('Category.index', [
        'title' => 'Category List',
        'data' => $data
    ]);
})->name('category');
Route::post('/category/create', function () {
    return view('Category.index', [
        'title' => 'Category List'
    ]);
})->name('category.store');

// Route Product
Route::get('/product', function () {
    $data = [
        [
            'id' => 1,
            'name' => 'Full Cream Milk',
            'sku' => 'R0000032',
            'id_category' => 1
        ],
        [
            'id' => 2,
            'name' => 'Sugar Local',
            'sku' => 'R0000027',
            'id_category' => 2
        ]
    ];
    $dataCategory = [
        [
        'id' => 1,
        'category_name' => 'Product Alergen',
        'description' => 'Product alergen seperti susu, kacang dan lain sebagainya.'
        ],
        [
            'id' => 2,
            'category_name' => 'Product Sukrosa',
            'description' => 'Produck sukrosa seperti gula, glukosa'
        ]
    ];

    $categoryMap = array_column($dataCategory, null, 'id');

    // Menggabungkan data dari kedua array berdasarkan ID kategori
    $result = array_map(function($item) use ($categoryMap) {
        $category = $categoryMap[$item['id_category']];
        return array_merge($item, $category);
    }, $data);

    return view('Product.index', [
        'title' => 'Product',
        'data' => $result,
        'category' => $dataCategory
    ]);
})->name('product');

// Route Storage Location
Route::get('/storage-location', function () {
    $data = [
        [
        'id' => 1,
        'kode_sloc' => 3001,
        'nama_sloc' => 'Gudang RM 86'
        ],
        [
        'id' => 2,
        'kode_sloc' => 3002,
        'nama_sloc' => 'Gudang RM 88'
        ],
    ];

    return view('StorageLocation.index', [
        'title' => 'Storage Location',
        'data' => $data
    ]);
})->name('sloc');

// Route Storage Bin
Route::get('/storage-bin', function () {
    $data = [
        [
        'id' => 1,
        'kode_bin' => 'MH0101',
        'nama_bin' => 'Rak MH Ganjil Level 1'
        ],
        [
        'id' => 2,
        'kode_bin' => 'MH0201',
        'nama_bin' => 'Rak MH Genap Level 1'
        ],
    ];

    return view('StorageBin.index', [
        'title' => 'Storage Bin',
        'data' => $data
    ]);
})->name('sbin');

//
Route::get('/profile', function (){
    return view('Profile.edit', [
        'title' => 'Profile'
    ]);
})->name('profile');

// Warehouse Management
Route::get('/warehouse/stock-report', function (){
    return view('warehouse.StockReport.create', [
        'title' => 'Filter Stock Report'
    ]);
})->name('warehouse.stock-report');
Route::get('/warehouse/stock-report/filter', function (){
    return view('warehouse.StockReport.index', [
        'title' => 'Stock Report'
    ]);
})->name('warehouse.stock-report.filter');

Route::get('/warehouse/receiving', function (){
    return view('warehouse.Receiving.index', [
        'title' => 'Receiving'
    ]);
})->name('warehouse.receiving');

Route::get('/warehouse/remove-from-storage', [RemoveFromStorageController::class, 'index'])->name('warehouse.remove-from-storage');
Route::post('/warehouse/remove-from-storage', [RemoveFromStorageController::class, 'generateSession'])->name('storeSession');
Route::any('/warehouse/remove-from-storage/update', [RemoveFromStorageController::class, 'sessionUpdate'])->name('updateSession');
