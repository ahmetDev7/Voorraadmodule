<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/producten/', [ProductController::class, 'index'])->name('products.index');
Route::get('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'index'])->name('products.index');
Route::post('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'add'])->name('products.add');
Route::get('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'edit'])->name('products.edit');
Route::put('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'update'])->name('products.update');
