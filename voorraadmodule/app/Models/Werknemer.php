<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Werknemer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'functie',
    ];
    // Define the relationship with Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'werknemer_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function serialNumbers()
    {
        return $this->belongsToMany(ProductSerialNumber::class, 'werknemer_products', 'werknemer_id', 'serialnumber_id');
    }

}
