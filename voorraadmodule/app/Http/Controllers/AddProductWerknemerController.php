<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Werknemer;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;

class AddProductWerknemerController extends Controller
{
    public function index($werknemerId)
    {
        $werknemer = Werknemer::findOrFail($werknemerId);

        $products = Product::all();

        $warehouse = Warehouse::all();

        $itemInWarehouses = ItemQuantityInWarehouses::all();


        return view('werknemers.addproduct', compact('werknemer', 'products', 'warehouse'));
    }

    // public function getItemoptions($warehouseID)
    // {
    //     $itemsinwarehouseID = ItemQuantityInWarehouses::where('warehouse_id', $warehouseID)->get(['product_id']);




    //     $optionsFinal
    //     foreach($itemsinwarehouseID as $itemtofind)
    //     {
    //         $options = Product::where('product_id', $itemsinwarehouseID)
    //     return response() ->json($options);
    // }

    // public function getmaxamount($warehouseID, $productID)
    // {

    // }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'werknemer_id' => 'required|exists:werknemers,id',
            'product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'WarehouseSelect' => 'required|exists:item_quantity_in_warehouses,warehouse_id|integer|min:1'
        ]);

        $werknemerID = $validatedData['werknemer_id'];
        $productID = $validatedData['product'];  // This is the product ID
        $quantity = $validatedData['quantity'];
        $warehouseID = $validatedData['WarehouseSelect']; // this is the ID of the warehouse

        $product = Product::find($productID);
        $werknemer = Werknemer::find($werknemerID);

        $warehouseItem = ItemQuantityInWarehouses::where('warehouse_id', $warehouseID)->where('product_id', $productID)->first();
        if ($warehouseItem && $warehouseItem->quantity >= $quantity)
        {
            $warehouseItem-> quantity -= $quantity;
            $warehouseItem->save();
        }
        else
        {
            return redirect()->to(url('/werknemer/' . $werknemerID . '/producten'))->with('success', 'product not in Warehouse!');
        }


        $exists = $werknemer->products()->where('product_id', $productID)->exists(); // checkt of er een duplicate komt


        if (!$exists) {
            $werknemer->products()->attach($product->id, ['quantity' => $quantity]);

        } else { // als het al bestaat word de quantity van het bestaande product plus met de nieuwe verzoek word gedaan
            $currentQuantity = $werknemer->products()->where('product_id', $productID)->first()->pivot->quantity;
            $newQuantity = $currentQuantity + $quantity;

            $werknemer->products()->updateExistingPivot($productID, ['quantity' => $newQuantity]);
        }


        return redirect()->to(url('/werknemer/' . $werknemerID . '/producten'))->with('success', 'Product updated successfully!');

    }

}
