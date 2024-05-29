<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Werknemer;
use App\Models\Product;

class AddProductWerknemerController extends Controller
{
    public function index($werknemerId)
    {
        $werknemer = Werknemer::findOrFail($werknemerId);

        $products = Product::all();

        return view('werknemers.addproduct', compact('werknemer', 'products'));
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

    }
}
