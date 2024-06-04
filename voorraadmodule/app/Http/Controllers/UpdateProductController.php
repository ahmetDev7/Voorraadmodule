<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ItemQuantityInWarehouses;
use App\Models\ProductSerialNumber;

class UpdateProductController extends Controller
{


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.update', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'productnummer' => 'required',
            'serialnumber' => 'required|string|required|max:255',
            'name' => 'required',
            'description' => 'required|string|required|max:255',
            'category' => 'required'
        ]);

        $product->productnummer = $request->input('productnummer');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->save();



        foreach ($request->input('itemQuantities') as $warehouseId => $data) {
            $request->validate([
                'itemQuantities.' . $warehouseId . '.quantity' => 'required|numeric|regex:/^[1-9]{0}[0-9]+$/'
            ]);

            $warehouseId = $warehouseId;

            $itemQuantity = ItemQuantityInWarehouses::where([
                'product_id' => $product->id,
                'warehouse_id' => $warehouseId
            ])->firstOrFail();


            $itemQuantity->quantity = $data['quantity'];
            $itemQuantity->save();
        }

        if ($request->has('deleteWarehouse')) {

            ItemQuantityInWarehouses::whereIn('warehouse_id', array_keys($request->deleteWarehouse))
            ->where('product_id', $product->id)
            ->delete();

        }

        return redirect()->back()->with('success', 'Product is succesvol bijgewerkt!');
    }
}
