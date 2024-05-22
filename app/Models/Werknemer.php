<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Werknemer extends Model
{
    // Define the relationship with Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'werknemer_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
