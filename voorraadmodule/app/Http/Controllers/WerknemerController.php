<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Werknemer;
use App\Models\werknemer_product;
use App\Models\ProductSerialNumber;
use App\Models\Product;

class WerknemerController extends Controller
{
    //
    public function index()
    {
        // Fetch all werknemers from the database
        $werknemers = Werknemer::all();

        // Pass the werknemers data to the view
        return view('werknemers.werknemers', compact('werknemers'));
    }
    public function showProducts($id)
    {
        // Retrieve the werknemer with their products
        $werknemer = Werknemer::find($id);

        // Get the werknemer's products
        $werknemerproducten = werknemer_product::where('werknemer_id', $id)->get();

        // Get the serial numbers IDs associated with the werknemer's products
        $serialnumbers = $werknemerproducten->pluck('serialnumber_id');

        // Get the serial number details from product_serial_numbers table
        $serialcodes = ProductSerialNumber::findMany($serialnumbers);

        // Get the product IDs associated with the serial numbers
        $serialcodeProducts = $serialcodes->pluck('product_id');

        // Get the products details
        $products = Product::findMany($serialcodeProducts);

        // Count of products
        $tocount = $serialcodeProducts->count();



        // Pass the data to the view
        return view('werknemers\inventory', compact('werknemer', 'products', 'serialcodes'));
    }


    //deze is get(werknemers/toevoegen)
    public function addView()
    {
        return view('werknemers.addwerknemer');
    }

    //deze is de post(Werknemer/toevoegen)
    public function Addwerknemer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'functie' => 'required|string'
        ]);


        $werknemer = new Werknemer();


        $werknemer->name = $request->input('name');
        $werknemer->email = $request->input('email');
        $werknemer->functie = $request->input('functie');

        $werknemer->save();

        return redirect()->back()->with('success', 'Werknemer is toegevoegd aan de database!');
    }

    //deze is get(werknemer/aanpassen/{id})
    public function EditEmployeePage(int $id)
    {
        $Employee = Werknemer::findOrFail($id);

        return view('werknemers/editwerknemer', compact('Employee'));
    }

    public function EditEmployeeActual(Request $request)
    {
        $request->validate([
            'id' => 'required|int|min:1',
            'name' => 'required|string',
            'email' => 'required|string',
            'functie' => 'required|string'
        ]);

        $werknemer = Werknemer::findOrFail($request->input('id'));


        $werknemer->name = $request->input('name');
        $werknemer->email = $request->input('email');
        $werknemer->functie = $request->input('functie');

        $werknemer->save();

        return redirect()->back()->with('success', 'Werknemer is succesvol aangepast!');
    }
}
