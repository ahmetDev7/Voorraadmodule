<?php

use App\Http\Controllers\AddProductWerknemerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/producten/', [ProductController::class, 'index'])->name('products.index');
Route::get('/werknemers/', [App\Http\Controllers\WerknemerController::class, 'index'])->name('werknemers.index');

Route::get('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'index'])->name('products.add');
Route::post('/producten/toevoegen', [App\Http\Controllers\AddProductController::class, 'add']);



Route::get('/werknemers/producten/toevoegen/{werknemerId}', [App\Http\Controllers\AddProductWerknemerController::class, 'index']);
Route::post('/werknemers/producten/toevoegen/{werknemerId}', [App\Http\Controllers\AddProductWerknemerController::class, 'store'])->name('submit.form');
Route::post('/products/select', [AddProductWerknemerController::class, 'index1']);
Route::get('/products/select/{werknemerId}', [AddProductWerknemerController::class, 'select'])->name('products.select');
Route::get('/products/select-warehouse', [AddProductWerknemerController::class, 'selectWarehouse'])->name('products.selectWarehouse');
//what?
Route::post('/products', [AddProductWerknemerController::class, 'store'])->name('products.store');

Route::get('/werknemer/{id}/producten', [App\Http\Controllers\WerknemerController::class, 'showProducts'])->name('werknemer.products');

Route::get('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'edit'])->name('products.edit');
Route::put('/producten/{id}/aanpassen', [App\Http\Controllers\UpdateProductController::class, 'update'])->name('products.update');
Route::get('/producten/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/archief', [ArchiveProductController::class, 'archief'])->name('products.list');
// Route::get('/producten/archief', [ArchiveProductController::class, 'archief'])->name('products.unarchive');
Route::get('/producten/{id}/archive', [ArchiveProductController::class, 'archive'])->name('products.archive');
Route::get('/producten/archive-reverse/{id}', [ArchiveProductController::class, 'archiveReverse'])->name('products.archiveReverse');

// toevoegen van de werknemers
Route::get('/werknemers/toevoegen', [App\Http\Controllers\WerknemerController::class, 'addView'])->name('werknemers.toevoegen');
Route::post('/werknemers/toevoegen', [App\Http\Controllers\WerknemerController::class, 'Addwerknemer']);
// aanpassen van de werknemers
Route::get('/werknemers/aanpassen/{id}', [App\Http\Controllers\WerknemerController::class, 'EditEmployeePage'])->name('werknemer.aanpassen');
Route::post('/werknemers/aanpassen/{id}', [App\Http\Controllers\WerknemerController::class, 'EditEmployeeActual']);//verwijderen van de werknemers
// verwijderen van de werknemers
Route::get('/werknemers/verwijderen/{id}', [App\Http\Controllers\DeleteEmployeeController::class, 'Deletewerknemer'])->name('werknemers.delete');


Route::get('/werknemer/{id}/products', [App\Http\Controllers\WerknemerController::class, 'showProducts'])->name('werknemer.products');
Route::get('/werknemer/search', [App\Http\Controllers\WerknemerSearchController::class, 'search'])->name('werknemer.search');

Route::get('/opslaglocaties/', [App\Http\Controllers\WarehouseController::class, 'index']);
Route::get('/opslaglocaties/toevoegen', [App\Http\Controllers\AddWarehousesController::class, 'index'])->name('warehouses.index');
Route::post('/opslaglocaties/toevoegen', [App\Http\Controllers\AddWarehousesController::class, 'add'])->name('warehouses.add');
Route::get('/opslaglocaties/{id}', [App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouses.show');
Route::get('/product-toevoegen-opslag/{id}', [App\Http\Controllers\ItemQuantityInWarehousesController::class, 'showAssignForm'])->name('itemquantityinwarehouses.showAssignForm');
Route::post('/product-toevoegen-opslag/{id}', [App\Http\Controllers\ItemQuantityInWarehousesController::class, 'assignProductToWarehouse'])->name('itemquantityinwarehouses.assignProductToWarehouse');


// deze zijn van het editen van warehouses
Route::get('/oplaglocaties/{id}/aanpassen', [App\Http\Controllers\WarehouseController::class, 'edit'])->name('warehouses.edit');
Route::put('/oplaglocaties/{id}/aanpassen', [App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouses.update');



Route::get('/producten-zoeken-bij-opslag/', [App\Http\Controllers\ProductenZoekenBijOpslaglocatiesController::class, 'search'])->name('ItemQuantityInWarehouses.search');

Route::get('/logs', [App\Http\Controllers\LoggerController::class, 'index'])->name('logger.index');


Route::get('/werknemer/{werkid}/{productid}/overdraag', [App\Http\Controllers\TransferToWarehouseController::class, 'index'])->name('products.transfer');
Route::post('/werknemer/overdraag', [App\Http\Controllers\TransferToWarehouseController::class, 'transfer'])->name('product.done');
