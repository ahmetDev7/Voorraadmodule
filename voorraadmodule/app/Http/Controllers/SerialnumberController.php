<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductSerialNumber;

class SerialnumberController extends Controller
{
    public function index()
    {
        $serienummers = ProductSerialNumber::with('product')->get();

        return view('serialnumbers.serialnumbers', compact('serienummers'));
    }

    public function deleteSerialnumber(int $id){
        $serialnumber = ProductSerialNumber::find($id);

        if (!$serialnumber) {
            return redirect()->back()->with('error', 'Serialnumber niet gevonden.');
        }

        $serialnumber->delete();

        return redirect()->back()->with('success', 'Serienummer is verwijderd uit de database!');
    }
}
