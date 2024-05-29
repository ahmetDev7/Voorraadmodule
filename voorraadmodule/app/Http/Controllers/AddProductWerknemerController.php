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
            'product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $werknemerID = $validatedData['werknemer_id'];
        $productID = $validatedData['product'];  // This is the product ID
        $quantity = $validatedData['quantity'];


        $product = Product::find($productID);
        $werknemer = Werknemer::find($werknemerID);


        $exists = $werknemer->products()->where('product_id', $productID)->exists(); // checkt of er een duplicate komt

        if (!$exists) {
            $werknemer->products()->attach($product->id, ['quantity' => $quantity]);

        } else { // als het al bestaat word de quantity van het bestaande product plus met de nieuwe verzoek word gedaan
            $currentQuantity = $werknemer->products()->where('product_id', $productID)->first()->pivot->quantity;
            $newQuantity = $currentQuantity + $quantity;

            $werknemer->products()->updateExistingPivot($productID, ['quantity' => $newQuantity]);
        }


        return redirect()->to(url('/werknemer/' . $werknemerID . '/producten'))->with('success', 'Product updated successfully!');

    }

}
