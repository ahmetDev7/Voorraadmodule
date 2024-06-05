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


//dit pakt alle unieke productID's en doet een findmany met productselect
        $validProductIDs = ItemQuantityInWarehouses::Select('product_id')->distinct()->pluck('product_id');
        $productsSelect = Product::findMany($validProductIDs);

//dit kiest het product
        return view('werknemers.addproduct', compact('werknemer', 'products', 'warehouse', 'werknemerId', 'productsSelect'));
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


    public function select($werknemerId)
    {
        $products = Product::all();

        return view('werknemers.addproduct', compact('products', 'werknemerId'));
    }
    public function index1(Request $request)
    {
        $validatedData = $request->validate([
            'werknemer_id' => 'required|exists:werknemers,id',
            'product_id' => 'required|integer|exists:products,id|exists:item_quantity_in_warehouses,product_id|min:1',
        ]);

        return redirect()->route('products.selectWarehouse', [
            'werknemer_id' => $validatedData['werknemer_id'],
            'product_id' => $validatedData['product_id']
        ]);


    }
    public function selectWarehouse(Request $request)
    {
        $werknemerId = $request->input('werknemer_id');
        $productId = $request->input('product_id');

        $werknemer = Werknemer::findOrFail($werknemerId);
        $product = Product::findOrFail($productId);

        // $warehouses = Warehouse::all();


        $warehouses = $product->warehouses1()->get();


        // Return the view for selecting warehouse with necessary data
        return view('werknemers.select-warehouse', compact('werknemerId', 'werknemer', 'product', 'warehouses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'werknemer_id' => 'required|exists:werknemers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'warehouse' => 'required|exists:item_quantity_in_warehouses,warehouse_id|integer|min:0'
        ]);

        $werknemerID = $validatedData['werknemer_id'];
        $productID = $validatedData['product_id'];  // This is the product ID
        $quantity = $validatedData['quantity'];
        $warehouseID = $validatedData['warehouse']; // this is the ID of the warehouse

        $product = Product::find($productID);
        $werknemer = Werknemer::find($werknemerID);

        $warehouseItem = ItemQuantityInWarehouses::where('warehouse_id', $warehouseID)->where('product_id', $productID)->first();

        if ($warehouseItem && $warehouseItem->quantity == $quantity)// checkt of de warehouse waarvan je afhaald genoeg heeft. als exact genoeg verwijdert het de product
        {
            ItemQuantityInWarehouses::destroy($warehouseItem->id);
        }
        else if ($warehouseItem && $warehouseItem->quantity > $quantity) // als de warenhuis meer dan genoeg heeft verlaagt het de kwantiteit
        {
            $warehouseItem->quantity -= $quantity;
            $warehouseItem->save();
        } else // anders gaat het direct weg
        {
            return redirect()->to(url('/werknemer/' . $werknemerID . '/producten'))->with('failure', 'product not in Warehouse!');
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
