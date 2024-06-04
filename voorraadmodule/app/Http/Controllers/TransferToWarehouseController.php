<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Werknemer;
use App\Models\Product;
use App\Models\Warehouse;




class TransferToWarehouseController extends Controller
{
    //
    public function index($werkid, $productid)
    {
        $product = Product::with('warehouses')->findOrFail($productid);

        $warehouses = Warehouse::all();

        $owner = Werknemer::with([
            'products' => function ($query) use ($productid) {
                $query->where('products.id', $productid);
            }
        ])->findOrFail($werkid);

        $quantity = $owner->products->first()->pivot->quantity ?? 0;

        return view('products.transferback', compact('product', 'warehouses', 'owner', 'quantity'));
    }



    public function validate(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'warehouse' => 'required|exists:warehouses,id',
        ]);
        $owner = $request->input('owner');
        $product = $request->input('product');
        $quantity = $validatedData['quantity'];
        $warehouse = $validatedData['warehouse'];

        $owner = Werknemer::findOrFail($owner);
        $warehouse = Warehouse::findOrFail($warehouse);


        $owner->quantity -= $quantity;
        $owner->save();

        $warehouse->quantity += $quantity;
        $warehouse->save();
    }

}
