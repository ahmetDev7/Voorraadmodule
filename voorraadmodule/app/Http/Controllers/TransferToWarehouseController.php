<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class TransferToWarehouseController extends Controller
{
    //
    public function index($id)
    {
        $Product = Product::find($id);
        $product = Product::with('warehouses')->findOrFail($id);


        return view('products\transferback', compact('product'));


    }

    public function validate()
    {

    }

}
