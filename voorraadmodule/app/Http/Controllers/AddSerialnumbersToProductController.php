<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductSerialNumber;


class AddSerialnumbersToProductController extends Controller
{
    public function showAddSerialForm()
    {
        $products = Product::all(); // Assuming you have a Product model and a products table

        return view('add_serial_form', compact('products'));
    }

    public function addSerial(Request $request)
    {
        // Handle the addition of a new product with a unique serial number here
    }
}
