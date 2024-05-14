<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ArchivedProduct;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.products', compact('products'));
    }
    public function archive($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        ArchivedProduct::create([
            'productnummer' => $product->productnummer,
            'name' => $product->name,
            'description' => $product->description,
            'category' => $product->category,
            'warehouse_id' => $product->warehouse_id,
        ]);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
