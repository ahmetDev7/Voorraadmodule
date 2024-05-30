<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/product/scan', function (Request $request) {
    $productId = $request->input('product_id');
    $werknemerId = $request->input('werknemer_id');

    return response()->json([
        'message' => 'Product scanned',
        'product_id' => $productId,
        'werknemer_id' => $werknemerId
    ]);
});