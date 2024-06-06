<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class AddWarehousesController extends Controller
{
    public function index()
    {
        return view('warehouses.add');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'street' => 'required|string|regex:/^[a-zA-Z0-9\-]+$/|max:60',
            'housenumber' => 'required|numeric|max:20000',
            'zipcode' => 'required|string|min:6|max:6|regex:/^[0-9]{4}[a-zA-Z]{2}$/',
            'city' => 'required|string|max:60|regex:/^[a-zA-Z\`]+$/',
            'country' => 'required|string|max:50|regex:/^[a-zA-Z\-]+$/'
        ], [
            'name.regex' => __('custom.name.regex'),
            'country.regex' => __('custom.country.regex'),
            'city.regex' => __('custom.city.regex'),
            'zipcode.regex' => __('custom.zipcode.regex'),
        ]);
        $warehouse  = new Warehouse();
        $warehouse->name = $request->input('name');
        $warehouse->street = $request->input('street');
        $warehouse->housenumber = $request->input('housenumber');
        $warehouse->zipcode = $request->input('zipcode');
        $warehouse->city = $request->input('city');
        $warehouse->country = $request->input('country');
        $warehouse->save();

        return redirect()->back()->with('success', 'opslaglocatie is succesvol toegevoegd!');
    }
}
