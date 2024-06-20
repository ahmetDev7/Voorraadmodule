<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductSerialNumber;


class AddSerialnumbersToProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('serialnumbers.add', compact('products'));
    }

    public function addSerialNumbertoProduct(Request $request)
    {
        $request->validate([
            'serialnumber_exist' => [
                'required',
                'string',
                'min:1',
                'max:60',
                'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/',
                'not_regex:/^-|-$/',
                'not_regex:/\s/',
            ],
        ], [
            'serialnumber_exist.regex' => __('validation.custom.serialnumber_exist.regex'),
        ]);

        if ($request->filled('existing_product_id')) {
            // Add serial number to existing product
            $product = Product::find($request->input('existing_product_id'));



            $existingSerialNumber = ProductSerialNumber::where('product_id', $product->id)
                ->where('serialnumber', $request->input('serialnumber_exist'))
                ->first();

            if ($existingSerialNumber) {
                return redirect()->back()->with('error', 'Dit serienummer is al gekoppeld aan dit product.');
            }


            $productSerialNumber = new ProductSerialNumber();
            $productSerialNumber->product_id = $product->id;
            $productSerialNumber->serialnumber = $request->input('serialnumber_exist');
            $productSerialNumber->productnumber = $product->productnummer;
            $productSerialNumber->save();

            return redirect()->back()->with('success', 'Serienummer is toegevoegd aan het bestaande product!');
        } else {
            return redirect()->back()->with('error', 'Selecteer een productnummer.');
        }
    }
}
