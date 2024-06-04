<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.warehouses', compact('warehouses'));
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $products = $warehouse->products()->withPivot('quantity')->get();
        return view('warehouses.ShowWareHouseProducts', compact('warehouse', 'products'));
    }


    // this is the get(/oplaglocaties/{id}/aanpassen)
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('warehouses.EditWarehouse', compact('warehouse'));
    }

    // this is the get(/oplaglocaties/{id}/aanpassen)
    public function update(Request $request, int $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $request->validate([
            'naam' => 'required|string',
            'straat' => 'required|string',
            'housenumber' => 'required|string',
            'category' => 'required'
        ]);

    }


}
