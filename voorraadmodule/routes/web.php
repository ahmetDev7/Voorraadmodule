<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/producten', function () {
    return view('products/products');
});

Route::get('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'index'])->name('products.index');
Route::post('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'add'])->name('products.add');
