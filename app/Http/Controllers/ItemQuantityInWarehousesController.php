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
            'quantity' => 'required',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        $existingItem = ItemQuantityInWarehouses::where('product_id', $request->id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();

        if ($existingItem) {
            return redirect()->back()->with('error', 'Product is already associated with this warehouse.');
        }
        $itemQuantityInWarehouse = new ItemQuantityInWarehouses();
        $itemQuantityInWarehouse->product_id = $request->id;
        $itemQuantityInWarehouse->warehouse_id = $request->warehouse_id;
        $itemQuantityInWarehouse->quantity = $request->quantity;
        $itemQuantityInWarehouse->save();
        return redirect()->back()->with('success', 'Product is succesvol aan een opslag toegevoegd.');
    }
}
