<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class ShowWarehouseProductsController extends Controller
{
    public function index()
    {
        return view('warehouses.add');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|required|max:255',
            'street' => 'required|string|required|max:255',
            'housenumber' => 'required|string|required|max:255',
            'zipcode' => 'required|string|required|max:255',
            'city' => 'required|string|required|max:255',
            'country' => 'required|string|required|max:255'
        ]);
        $warehouse  = new Warehouse();
        $warehouse->name = $request->input('name');
        $warehouse->street = $request->input('street');
        $warehouse->housenumber = $request->input('housenumber');
        $warehouse->zipcode = $request->input('zipcode');
        $warehouse->city = $request->input('city');
        $warehouse->country = $request->input('country');
        $warehouse->save();

        return redirect()->back()->with('success', 'opslaglocatie is toegevoegd aan de database!');
    }
}
