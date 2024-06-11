<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;


class WarehouseSearchController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.warehouses', compact('warehouses'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == null) {
            $warehouses = Warehouse::all();
        } else {
            $warehouses = Warehouse::where('name', 'like', '%' . $search . '%')
                ->orWhere('street', 'like', '%' . $search . '%')
                ->orWhere('zipcode', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->get();
        }

        return view('warehouses.warehouses', compact('warehouses', 'search'));
    }
}
