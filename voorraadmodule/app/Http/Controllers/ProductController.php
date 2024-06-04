<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Werknemer;
use Illuminate\Support\Facades\Auth;


use App\Models\ArchivedProduct;
use App\Models\ItemQuantityInWarehouses;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('warehouses')->get();
        return view('products.products', compact('products'));
    }
}
