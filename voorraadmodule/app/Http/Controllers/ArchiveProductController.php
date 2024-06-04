<?php

namespace App\Http\Controllers;

use App\Models\ArchivedProduct;
use Illuminate\Http\Request;
use App\Models\Product;


class ArchiveProductController extends Controller
{
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
            'category' => $product->category
        ]);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function archiveReverse($id)
    {
        $ArchivedProduct = ArchivedProduct::find($id);

        if (!$ArchivedProduct) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        Product::create([
            'productnummer' => $ArchivedProduct->productnummer,
            'name' => $ArchivedProduct->name,
            'description' => $ArchivedProduct->description,
            'category' => $ArchivedProduct->category
        ]);

        $ArchivedProduct->delete();

        return redirect()->route('products.list')->with('success', 'Product deleted successfully.');
    }

    public function archief()
    {
        $products = ArchivedProduct::all();
        return view('products.archief', compact('products'));
    }


}
