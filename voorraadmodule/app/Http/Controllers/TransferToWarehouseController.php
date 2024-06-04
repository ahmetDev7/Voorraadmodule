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
        $Product = Product::with('Warehouse')->findOrFail($id);


        return view('products\transferback', compact('Product'));


    }

    public function validate()
    {

    }

}
