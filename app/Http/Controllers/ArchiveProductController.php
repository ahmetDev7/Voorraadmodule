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
            'serialnumber' => 'required|exists:products,serialnumber',
        ]);

        // Retrieve the product by serialnumber
        $product = Product::where('serialnumber', $request->input('serialnumber'))->firstOrFail();

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
