<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemQuantityInWarehouses;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ProductSerialNumber;

class ItemQuantityInWarehousesController extends Controller
{

    public function showAssignForm($id)
    {
        $product = Product::findOrFail($id);
        $warehouses = Warehouse::all(); 
        $assignedSerialNumbers = ItemQuantityInWarehouses::pluck('serial_number')->toArray();
        $serialNumbers = ProductSerialNumber::where('product_id', $product->id)
                                            ->whereNotIn('serialnumber', $assignedSerialNumbers)
                                            ->get();
        return view('ItemQuantityInWarehouseses\AssignProductToWarehouse', compact('product', 'warehouses', 'serialNumbers'));
    }

    public function assignProductToWarehouse(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'serial_numbers' => 'required|array',
            'product_id' => 'required|exists:products,id',
            [
                'quantity.regex' => __('custom.quantity.regex'),
            ]
        ]);



        foreach ($request->serial_numbers as $serialNumber) {

            $itemQuantityInWarehouse = new ItemQuantityInWarehouses();
            $itemQuantityInWarehouse->product_id = $request->product_id;
            $itemQuantityInWarehouse->warehouse_id = $request->warehouse_id;
            $itemQuantityInWarehouse->serial_number = $serialNumber; 
            $itemQuantityInWarehouse->save();
        }

        return redirect()->back()->with('success', 'Product is succesvol aan een opslag toegevoegd.');
    }
}
