<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemQuantityInWarehouses;
use App\Models\Warehouse;
use App\Models\Product;

class ItemQuantityInWarehousesController extends Controller
{

    public function showAssignForm($id)
    {
        $product = Product::findOrFail($id);
        $warehouses = Warehouse::all(); 
        return view('ItemQuantityInWarehouseses\AssignProductToWarehouse', compact('product', 'warehouses'));
    }

    public function assignProductToWarehouse(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|regex:/^[1-9]{0}[0-9]+$/',
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            [
                'quantity.regex' => __('custom.quantity.regex'),
            ]
        ]);

        $existingItem = ItemQuantityInWarehouses::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();

        if ($existingItem) {
            return redirect()->back()->with('error', 'Product is al in deze opslaglocatie.');
        }

        $itemQuantityInWarehouse = new ItemQuantityInWarehouses();
        $itemQuantityInWarehouse->product_id = $request->product_id;
        $itemQuantityInWarehouse->warehouse_id = $request->warehouse_id;
        $itemQuantityInWarehouse->quantity = $request->quantity;
        $itemQuantityInWarehouse->save();

        return redirect()->back()->with('success', 'Product is succesvol aan een opslag toegevoegd.');
    }
}
