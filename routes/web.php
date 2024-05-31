<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\RemoveFromStorageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StorageBinController;
use App\Http\Controllers\StorageLocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::group(['middleware' => ['auth']], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::any('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->where('id', '[0-9]+');
    Route::any('/user/{id}/update', [UserController::class, 'update'])->name('user.update')->where('id', '[0-9]+');
    Route::any('/user/{id}/update-password', [UserController::class, 'updatePassword'])->name('user.update.password')->where('id', '[0-9]+');
    Route::any('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy')->where('id', '[0-9]+');

    // Route Role
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::any('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update')->where('id', '[0-9]+');
    Route::any('/roles/{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy')->where('id', '[0-9]+');


    // Route Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::any('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update')->where('id', '[0-9]+');
    Route::any('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy')->where('id', '[0-9]+');

    // Route Product
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::any('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::any('/product/{id}/update', [ProductController::class, 'update'])->name('product.update')->where('id', '[0-9]+');
    Route::any('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy')->where('id', '[0-9]+');

    // Route Storage Location
    Route::get('/sloc', [StorageLocationController::class, 'index'])->name('sloc');
    Route::post('/sloc/store', [StorageLocationController::class, 'store'])->name('sloc.store');
    Route::any('/sloc/{id}/update', [StorageLocationController::class, 'update'])->name('sloc.update')->where('id', '[0-9]+');
    Route::any('/sloc/{id}/destroy', [StorageLocationController::class, 'destroy'])->name('sloc.destroy')->where('id', '[0-9]+');

    // Route Storage Bin
    Route::get('/sbin', [StorageBinController::class, 'index'])->name('sbin');
    Route::post('/sbin/store', [StorageBinController::class, 'store'])->name('sbin.store');
    Route::any('/sbin/{id}/update', [StorageBinController::class, 'update'])->name('sbin.update')->where('id', '[0-9]+');
    Route::any('/sbin/{id}/sloc', [StorageBinController::class, 'getBySlocId'])->name('sbin.slocId')->where('id', '[0-9]+');
    Route::any('/sbin/{id}/destroy', [StorageBinController::class, 'destroy'])->name('sbin.destroy')->where('id', '[0-9]+');


    //
    Route::get('/profile', function (){
        return view('Profile.edit', [
            'title' => 'Profile'
        ]);
    })->name('profile');

    // Warehouse Management
    Route::get('/warehouse/history', [WarehouseManagementController::class, 'history'])->name('warehouse.history');
    Route::get('/warehouse/stock-report', [WarehouseManagementController::class, 'stock'])->name('warehouse.stock-report');
    Route::get('/warehouse/stock-report/filter', [WarehouseManagementController::class, 'filter'])->name('warehouse.stock-report.filter');

    Route::get('/warehouse/receiving', [ReceivingController::class, 'index'])->name('warehouse.receiving');
    Route::any('/warehouse/receiving/store', [ReceivingController::class, 'store'])->name('warehouse.receiving.store');
    Route::any('/warehouse/receiving/{id}/print', [ReceivingController::class, 'print'])->name('warehouse.receiving.print');
    Route::any('/warehouse/receiving/session-store', [ReceivingController::class, 'sessionStore'])->name('warehouse.receiving.sessionStore');
    Route::any('/warehouse/receiving/session-update', [ReceivingController::class, 'sessionUpdate'])->name('warehouse.receiving.sessionUpdate');
    Route::any('/warehouse/receiving/session-delete', [ReceivingController::class, 'sessionDestroy'])->name('warehouse.receiving.sessionDestroy');

    Route::get('/warehouse/remove-from-storage', [RemoveFromStorageController::class, 'index'])->name('warehouse.remove-from-storage');
    Route::any('/warehouse/remove-from-storage/store', [RemoveFromStorageController::class, 'store'])->name('warehouse.remove-from-storage.store');
    Route::any('/warehouse/remove-from-storage/{id}/print', [RemoveFromStorageController::class, 'print'])->name('warehouse.remove-from-storage.print');
    Route::any('/warehouse/remove-from-storage/session-store', [RemoveFromStorageController::class, 'sessionStore'])->name('storeSession');
    Route::any('/warehouse/remove-from-storage/session-update', [RemoveFromStorageController::class, 'sessionUpdate'])->name('updateSession');
    Route::any('/warehouse/remove-from-storage/session-delete', [RemoveFromStorageController::class, 'sessionDestroy'])->name('deleteSession');
});
