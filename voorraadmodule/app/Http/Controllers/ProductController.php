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

    public function showForm($werknemerId)
    {
        $werknemer = Werknemer::findOrFail($werknemerId);

        $products = Product::all();

        return view('products.form', compact('werknemer', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'werknemer_id' => 'required|exists:werknemers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);


        $werknemerID = $validatedData['werknemer_id'];
        $productID = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        $product = Product::findOrFail($productID);
        $product->name = 'test';


        $product->save();



        return redirect()->route('some.route')->with('success', 'Product created successfully.');





    }






}
