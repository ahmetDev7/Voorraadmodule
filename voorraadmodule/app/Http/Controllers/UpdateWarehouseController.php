<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('warehouses.update', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z0-9\-]+$/|required|max:60',
            'street' => 'required|string|regex:/^[a-zA-Z0-9\-]+$/|required|max:60',
            'housenumber' => 'required|numeric|required|max:20000',
            'zipcode' => 'required|string|required|min:6|max:6|required|regex:/^[0-9]{4}[a-zA-Z]{2}$/',
            'city' => 'required|string|required|max:60|regex:/^[a-zA-Z\`]+$/',
            'country' => 'required|string|required|max:50|regex:/^[a-zA-Z\-]+$/', [
                'name.regex' => __('custom.name.regex'),
                'country.regex' => __('custom.country.regex'),
                'city.regex' => __('custom.city.regex'),
                'zipcode.regex' => __('custom.zipcode.regex'),
            ]
        ]);

        $warehouse->name = $request->input('name');
        $warehouse->street = $request->input('street');
        $warehouse->housenumber = $request->input('housenumber');
        $warehouse->zipcode = $request->input('zipcode');
        $warehouse->city = $request->input('city');
        $warehouse->country = $request->input('country');

        $warehouse->save();
    }
}
