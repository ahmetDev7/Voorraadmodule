<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the relationship with Werknemer
    public function werknemers()
    {
        return $this->belongsToMany(Werknemer::class, 'werknemer_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
