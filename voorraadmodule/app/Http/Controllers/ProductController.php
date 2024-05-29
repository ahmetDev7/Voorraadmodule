<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Werknemer;
use Illuminate\Support\Facades\Auth;


use App\Models\ArchivedProduct;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.products', compact('products'));
    }
}
