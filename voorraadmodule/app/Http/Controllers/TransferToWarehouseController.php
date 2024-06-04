<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;



class TransferToWarehouseController extends Controller
{
    //
    public function index($id)
    {
        $product = Product::with('warehouses')->findOrFail($id);
        $warehouses = Warehouse::all();

        return view('products\transferback', compact('product', 'warehouses'));


    }

    public function validate()
    {

    }

}
