<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ArchivedProduct;
use App\Models\ItemQuantityInWarehouses;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('warehouses')->get();

        
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $warehouses = $product->warehouses()->withPivot('quantity')->get();
        return view('products.showQuantityProductsForeachEachWarehouse', compact('warehouses', 'product'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == null) {
            $products = Product::all();
        } else {
            $products = Product::where('productnummer', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->get();
        }

        return view('products.products', compact('products', 'search'));
    }
}