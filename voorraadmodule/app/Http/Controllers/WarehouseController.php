<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Product;


class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.warehouses', compact('warehouses'));
    }

    public function show($id)
    {
        // Find the warehouse by ID
        $warehouse = Warehouse::findOrFail($id);
    
        // Get products with their quantities specific to the selected warehouse
        $products = Product::withCount(['serialNumbers as serial_numbers_count' => function ($query) use ($id) {
            $query->join('item_quantity_in_warehouses', 'product_serial_numbers.serialnumber', '=', 'item_quantity_in_warehouses.serial_number')
                  ->where('item_quantity_in_warehouses.warehouse_id', $id);
        }])
        ->whereHas('serialNumbers', function ($query) use ($id) {
            $query->join('item_quantity_in_warehouses', 'product_serial_numbers.serialnumber', '=', 'item_quantity_in_warehouses.serial_number')
                  ->where('item_quantity_in_warehouses.warehouse_id', $id);
        })
        ->get();
    
        return view('warehouses.ShowWareHouseProducts', compact('warehouse', 'products'));
    }


    // this is the get(/oplaglocaties/{id}/aanpassen)
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('warehouses.EditWarehouse', compact('warehouse'));
    }

    // this is the put(/oplaglocaties/{id}/aanpassen)
    public function update(Request $request, int $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $request->validate([
            'naam' => 'required|string',
            'straat' => 'required|string',
            'huisnummer' => 'required|string',
            'postcode' => 'required|string|min:6|max:6',
            'stad' => 'required|string',
            'land' => 'required|string'
        ]);

        $warehouse->name = $request->input('naam');
        $warehouse->street = $request->input('straat');
        $warehouse->housenumber = $request->input('huisnummer');
        $warehouse->zipcode = $request->input('postcode');
        $warehouse->city = $request->input('stad');
        $warehouse->country = $request->input('land');

        $warehouse->save();

        return redirect()->back()->with('success', 'Opslaglocatie is succesvol bijgewerkt!');
    }
}
