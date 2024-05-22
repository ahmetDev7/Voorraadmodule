<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/producten/', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
// Route::get('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'index'])->name('products.index');
// Route::post('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'add'])->name('products.add');
// Route::get('/producten/archiveren', [App\Http\Controllers\ArchiveProductController::class, 'index'])->name('products.index');
// Route::post('/producten/archiveren', [App\Http\Controllers\ArchiveProductController::class, 'archive'])->name('products.archive');
// Route::get('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'edit'])->name('products.edit');
// Route::put('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'update'])->name('products.update');


Route::get('/', function () {
    return view('home');
});

Route::get('/producten/', [ProductController::class, 'index'])->name('products.index');
Route::get('/Werknemers/', [App\Http\Controllers\WerknemerController::class, 'index'])->name('werknemers.index');

Route::get('/products/{id}/archive', [ProductController::class, 'archive'])->name('products.archive');
Route::get('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'index'])->name('products.add'); // Changed route name to 'products.add'
Route::post('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'add']);
Route::get('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'edit'])->name('products.edit');
Route::put('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'update'])->name('products.update');




Route::get('/werknemer/{id}/products', [App\Http\Controllers\WerknemerController::class, 'showProducts'])->name('werknemer.products');
