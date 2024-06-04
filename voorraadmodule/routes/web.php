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
Route::get('/producten/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


// toevoegen van de werknemers
Route::get('/Werknemers/toevoegen', [App\Http\Controllers\WerknemerController::class, 'addView'])->name('werknemers.toevoegen');
Route::post('/Werknemers/toevoegen', [App\Http\Controllers\WerknemerController::class, 'Addwerknemer']);


Route::get('/werknemer/{id}/products', [App\Http\Controllers\WerknemerController::class, 'showProducts'])->name('werknemer.products');

Route::get('/opslaglocaties/', [App\Http\Controllers\WarehouseController::class, 'index']);
Route::get('/opslaglocaties/toevoegen', [App\Http\Controllers\AddWarehousesController::class, 'index'])->name('warehouses.index');
Route::post('/opslaglocaties/toevoegen', [App\Http\Controllers\AddWarehousesController::class, 'add'])->name('warehouses.add');
Route::get('/opslaglocaties/{id}', [App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouses.show');
Route::get('/product-toevoegen-opslag/{id}', [App\Http\Controllers\ItemQuantityInWarehousesController::class, 'showAssignForm'])->name('itemquantityinwarehouses.showAssignForm');
Route::post('/product-toevoegen-opslag/{id}', [App\Http\Controllers\ItemQuantityInWarehousesController::class, 'assignProductToWarehouse'])->name('itemquantityinwarehouses.assignProductToWarehouse');


Route::get('/producten-zoeken-bij-opslag/', [App\Http\Controllers\ProductenZoekenBijOpslaglocatiesController::class, 'search'])->name('ItemQuantityInWarehouses.search');

Route::get('/logs', [App\Http\Controllers\LoggerController::class, 'index'])->name('logger.index');
