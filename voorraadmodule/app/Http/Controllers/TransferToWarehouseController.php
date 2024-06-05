<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Werknemer;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;

use Illuminate\Support\Facades\DB;





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

    public function transfer(Request $request)
    {
        $validatedData = $request->validate([
            'ownerid' => 'required',
            'productid' => 'required',
            'quantity' => 'required|integer|min:1',
            'warehouse' => 'required',
        ]);

        $ownerId = $validatedData['ownerid'];
        $productId = $validatedData['productid'];
        $quantity = $validatedData['quantity'];
        $warehouseId = $validatedData['warehouse'];

        $owner = Werknemer::find($ownerId);
        $product = Product::find($productId);

        $quantityInPivot = $owner->products()->where('product_id', $productId)->first()->pivot->quantity;


        $check = ItemQuantityInWarehouses::where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->first();
        $itemQuantity = new ItemQuantityInWarehouses();
        $itemQuantity->product_id = $productId;
        $itemQuantity->warehouse_id = $warehouseId;
        $itemQuantity->quantity = $quantity;

        if ($quantityInPivot > $quantity) {

            $owner->products()->updateExistingPivot($productId, ['quantity' => $quantityInPivot - $quantity]);



        } elseif ($quantityInPivot == $quantity) {
            DB::table('werknemer_product')
                ->where('werknemer_id', $owner->id)
                ->where('product_id', $product->id)
                ->delete();
        } else {
            return; // zou nooit moeten kunnen
        }
        if ($check) {
            $check->quantity += $quantity;
            $check->save();
        } else {
            $itemQuantity = new ItemQuantityInWarehouses();
            $itemQuantity->product_id = $productId;
            $itemQuantity->warehouse_id = $warehouseId;
            $itemQuantity->quantity = $quantity;
            $itemQuantity->save();
        }

        return redirect("/werknemer/{$owner->id}/products");
    }



}
