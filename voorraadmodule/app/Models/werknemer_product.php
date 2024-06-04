<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class werknemer_product extends Model
{
    public $timestamps = true;
    use HasFactory;

    protected $fillable = [
        'id',
        'werknemer_id',
        'product_id',
        'quantity'
    ];

}
