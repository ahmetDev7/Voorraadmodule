<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Werknemer;


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
        $werknemer = Werknemer::with('products')->findOrFail($id);

        // Pass the data to the view
        return view('werknemers\inventory', compact('werknemer'));
    }
}
