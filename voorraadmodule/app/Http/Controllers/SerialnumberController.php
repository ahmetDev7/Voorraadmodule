<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SerialnumberController extends Controller
{
    public function index()
    {
        return view('serialnumbers.serialnumbers');
    }
}
