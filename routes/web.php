<?php

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
    return view('StorageLocation.index');
})->name('sloc');

// Route Storage Bin
Route::get('/storage-bin', function () {
    return view('StorageBin.index');
})->name('sbin');
