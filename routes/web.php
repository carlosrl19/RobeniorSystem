<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('products');
});

Route::get('register', function () {
    return redirect('/');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('products');
    });

    // Products routes
    Route::resource('products', 'App\Http\Controllers\ProductsController')->names('products');
    Route::get('products/inventory/export/all', 'App\Http\Controllers\ProductsController@inventory_report')->name('products.inventory_report');

    // Categories routes
    Route::resource('categories', 'App\Http\Controllers\CategoryController')->names('categories');

    // User history routes
    Route::resource('users_history', 'App\Http\Controllers\UserHistoryController')->names('users_history');
});
