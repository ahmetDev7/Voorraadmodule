<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Werknemer;


class WerknemerSearchController extends Controller
{
    //
    public function index()
    {
        // Fetch all werknemers from the database
        $werknemers = Werknemer::all();

        // Pass the werknemers data to the view
        return view('werknemers.werknemers', compact('werknemers'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search == null) {
            $werknemers = Werknemer::all();
        } else {
            $werknemers = Werknemer::where('name', 'like', '%' . $search . '%')
                ->orWhere('functie', 'like', '%' . $search . '%')
                ->get();
        }

        return view('werknemers.werknemers', compact('werknemers', 'search'));
    }
    
}
