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
        $warehouse = Warehouse::with(['products' => function ($query) {
            $query->withCount('serialNumbers');
        }])->findOrFail($id);


        return view('warehouses.ShowWareHouseProducts', compact('warehouse'));
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
