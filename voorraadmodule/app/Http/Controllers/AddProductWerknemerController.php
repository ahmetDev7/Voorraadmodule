<?php

namespace App\Http\Controllers;

use App\Models\ProductSerialNumber;
use App\Models\werknemer_product;
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



//dit pakt alle unieke productID's en doet een findmany met productselect
        $validProductIDs = ItemQuantityInWarehouses::Select('product_id')->distinct()->pluck('product_id');
        $productsSelect = Product::findMany($validProductIDs);

//dit kiest het product
        return view('werknemers.addproduct', compact('werknemer', 'werknemerId', 'productsSelect'));
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


        $productsinWarehouses = ItemQuantityInWarehouses::where('product_id', $productId);

        $validwarehouses = Warehouse::findMany($productsinWarehouses->pluck('warehouse_id'));



        // Return the view for selecting warehouse with necessary data
        return view('werknemers.select-warehouse', compact('werknemerId', 'werknemer', 'product', 'productsinWarehouses', 'validwarehouses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'werknemer_id' => 'required|exists:werknemers,id',
            'product_id' => 'required|exists:products,id',
            'serialnumber' => 'required|string|exists:item_quantity_in_warehouses,serial_number',
        ]);

        $werknemerID = $validatedData['werknemer_id'];
        $productID = $validatedData['product_id'];  // This is the product ID
        $serialnumber = $validatedData['serialnumber'];

        $warehouseItem = ItemQuantityInWarehouses::where('serial_number', $serialnumber)->where('product_id', $productID)->first()->pluck('id');


        $serial_id = ProductSerialNumber::where('serialnumber', $serialnumber)->where('product_id', $productID)->pluck('id');



        werknemer_product::create([
            'werknemer_id' => $werknemerID,
            'serialnumber_id' => $serial_id[0]
        ])->save();

        $warehouseItem = ItemQuantityInWarehouses::find($warehouseItem[0]);
        if ($warehouseItem) {
            $warehouseItem->delete();
        }
        return redirect()->to(route('werknemer.products', $werknemerID))->with('success', 'Product updated successfully!');

    }

}
