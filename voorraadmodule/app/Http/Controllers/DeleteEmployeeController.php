<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Werknemer;
use App\Models\werknemer_product;

class DeleteEmployeeController extends Controller
{
    // Deze is de get(/werknemers/verwijderen/{id})
    public function Deletewerknemer(Request $request, int $id)
    {
        $employee = Werknemer::find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Werknemer niet gevonden.');
        }

        $productsToDelete = Werknemer_product::where('werknemer_id', $id);

        foreach ($productsToDelete as $product)
        {
            $toremoveproduct = werknemer_product::find($product->id);
            $toremoveproduct -> delete();
        }


        $employee->delete();

        return redirect()->back()->with('success', 'Werknemer is verwijdert uit de database!');
    }
}
