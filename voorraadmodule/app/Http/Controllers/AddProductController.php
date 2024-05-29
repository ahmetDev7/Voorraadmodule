<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class AddProductController extends Controller
{
    public function index()
    {
        return view('products/add');
    }
    public function indexForEmployee()
    {
        return view('products/addToEmployee');
    }

    public function add(Request $request)
    {
        $request->validate([
            'productnummer' => 'required',
            'name' => 'required',
            'description' => 'required|string|required|max:255',
            'category' => 'required',
        ]);
        $product = new Product();
        $product->productnummer = $request->input('productnummer');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->save();

        return redirect()->back()->with('success', 'Product is toegevoegd aan de database!');
    }


}
