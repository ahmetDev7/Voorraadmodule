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
            'street' => 'required|string|min:3|max:60|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\-]*[a-zA-Z0-9]$/',
            'housenumber' => 'required|regex:/^[0-9]{1,5}[a-zA-Z0-9]*[0-9]$/',
            'zipcode' => 'required|string|min:6|max:6|regex:/^[0-9]{4}[a-zA-Z]{2}$/',
            'city' => "required|string|min:6|max:60|regex:/^(?!-)[a-zA-Z\s'-]+(?<!-)$/",
            'country' => 'required|string|min:6|max:50|regex:/^[a-zA-Z]+(?:[ -][a-zA-Z]+)*$/'
        ], [
            'name.regex' => __('custom.name.regex'),
            'street.regex' => __('validation.custom.street.regex'),
            'housenumber.regex' => __('validation.custom.housenumber.regex'),
            'country.regex' => __('validation.custom.country.regex'),
            'city.regex' => __('validation.custom.city.regex'),
            'zipcode.regex' => __('validation.custom.zipcode.regex'),
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
