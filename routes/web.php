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

    Route::resource('products', 'App\Http\Controllers\ProductsController')->names('products');
    Route::resource('users_history', 'App\Http\Controllers\UserHistoryController')->names('users_history');
});
