<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UpdateProductController extends Controller
{


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.update', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->productnummer = $request->input('productnummer');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->save();

        return redirect()->back()->with('success', 'Product is succesvol bijgewerkt!');
    }
}
