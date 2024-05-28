<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Logger;
use App\Models\Log;

class LoggerController extends Controller
{
    public function index()
    {
        // Logger::log("Product 1 is verplaatst naar opslaglocatie A");
        $logs = Log::all();
        return view('logger.logger', compact('logs'));
    }
}
