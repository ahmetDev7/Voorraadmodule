<?php

namespace App\Services;

use App\Models\Log;

class Logger
{
    public static function log($action)
    {
        Log::create([
            'action' => $action,
        ]);
    }
}