<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;


class ProductenZoekenBijOpslaglocatiesController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->input('search');
        if ($search == null) {
            $warehouses = Warehouse::all();
            return view('ItemQuantityInWarehouseses.productenZoekenVoorOpslaglocaties', compact('warehouses'));
        } else {
            $warehouses = ItemQuantityInWarehouses::join('warehouses', 'item_quantity_in_warehouses.warehouse_id', '=', 'warehouses.id')
                ->join('products', 'item_quantity_in_warehouses.product_id', '=', 'products.id')
                ->select('item_quantity_in_warehouses.*', 'warehouses.*', 'products.id as product_id')
                ->Where('products.productnummer', 'like', $search)
                ->orWhere('products.name', 'like', $search)
                ->orWhere('products.category', 'like', $search)
                ->get();
                
            return view('ItemQuantityInWarehouseses.productenZoekenVoorOpslaglocaties', compact('warehouses', 'search'));
        }
    }
}
