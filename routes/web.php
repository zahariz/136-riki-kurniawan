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
Route::get('/category', function () {
    $data = [
        [
            'category_name' => 'Product Alergen',
        'description' => 'Product alergen seperti susu, kacang dan lain sebagainya.'
        ],
        [
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
