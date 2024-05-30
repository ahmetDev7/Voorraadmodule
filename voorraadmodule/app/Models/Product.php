<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the relationship with Werknemer
    protected $fillable = [
        'productnummer',
        'name',
        'description',
        'category',
        'warehouse_id',
    ];
    public function werknemers()
    {
        return $this->belongsToMany(Werknemer::class, 'werknemer_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function warehouses()
    {
        return $this->belongsToMany(ItemQuantityInWarehouses::class, 'id')
            ->withPivot('quantity');
    }
}
