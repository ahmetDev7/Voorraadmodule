<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Werknemer;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;
use App\Models\ProductSerialNumber;
use App\Models\werknemer_product;
use Illuminate\Support\Facades\DB;





class TransferToWarehouseController extends Controller
{
    //
    public function index($werkid, $productid)
    {
        $product = Product::find($productid);

        $warehouses = Warehouse::all();

        $owner = Werknemer::find($werkid);

        return view('products.transferback', compact('product', 'warehouses', 'owner', ));
    }

    public function transfer(Request $request)
    {
        $validatedData = $request->validate([
            'ownerid' => 'required',
            'productid' => 'required',
            'warehouse' => 'required',
        ]);

        $ownerId = $validatedData['ownerid'];
        $productId = $validatedData['productid'];
        $warehouseId = $validatedData['warehouse'];

        $owner = Werknemer::find($ownerId);
        $product = Product::find($productId);

        $ProductToWarehouseID = werknemer_product::where('werknemer_id', $ownerId)->first();
        $productToWarehouse = ProductSerialNumber::where('id', $ProductToWarehouseID->id)->first();






        $goal = new ItemQuantityInWarehouses();
        $goal->product_id = $productId;
        $goal->serial_number = $productToWarehouse->serialnumber;
        $goal->warehouse_id = $warehouseId;
        $goal->save();

        $ProductToWarehouseID->delete();
        $productToWarehouse->delete();
        return redirect("/werknemer/{$owner->id}/producten");
    }


}
