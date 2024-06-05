<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductSerialNumber;


class AddProductController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();
        // Pass the warehouses to the view
        return view('products.add', compact('warehouses', 'products'));
    }
    public function indexForEmployee()
    {
        return view('products/addToEmployee');
    }

    public function add(Request $request)
    {
        $request->validate([
            'productnummer' => 'required|int',
            'name' => 'required|string',
            'description' => 'required|string|required|max:255',
            'category' => 'required|string'
        ]);
        $product = new Product();
        $product->productnummer = $request->input('productnummer');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category = $request->input('category');

        $product->save();

        if ($request->filled('existing_product_id')) {
            // Add serial number to existing product
            $product = Product::find($request->input('existing_product_id'));

            $request->validate([
                'serialnumber_exist' => 'required',
            ]);

            $productSerialNumber = new ProductSerialNumber();
            $productSerialNumber->product_id = $product->id;
            $productSerialNumber->serialnumber = $request->input('serialnumber_exist');
            $productSerialNumber->productnumber = $product->productnummer;
            $productSerialNumber->save();

            return redirect()->back()->with('success', 'Serial number toegevoegd aan het bestaande product!');
        } else {
            $request->validate([
                'productnummer' => 'required|unique:products,productnummer',
                'serialnumber' => 'required',
                'name' => 'required',
                'description' => 'required|string|max:255',
                'category' => 'required'
            ]);

            $product = new Product();
            $product->productnummer = $request->input('productnummer');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->category = $request->input('category');
            $product->save();

            $productSerialNumber = new ProductSerialNumber();
            $productSerialNumber->product_id = $product->id;
            $productSerialNumber->serialnumber = $request->input('serialnumber');
            $productSerialNumber->productnumber = $product->productnummer;
            $productSerialNumber->save();

            return redirect()->back()->with('success', 'Nieuw product en serienummer toegevoegd aan de database!');
        }
    }


}
