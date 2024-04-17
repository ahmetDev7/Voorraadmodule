<?php

namespace App\Http\Controllers;

use App\Models\ArchivedProduct;
use Illuminate\Http\Request;
use App\Models\Product;


class ArchiveProductController extends Controller
{
    public function index()
    {
        return view('products.archive');
    }

    public function archive(Request $request)
    {

        // Validate the request
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        // Retrieve the product by ID
        $product = Product::findOrFail($request->input('id'));

        // Create a new archived product record
        ArchivedProduct::create([
            'serialnumber' => $product->serialnumber,
            'name' => $product->name,
            'description' => $product->description,
            'category' => $product->category,
            'warehouse_id' => $product->warehouse_id,
        ]);

        // Delete the product from the main products table
        $product->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product has been archived successfully!');
    }
}
