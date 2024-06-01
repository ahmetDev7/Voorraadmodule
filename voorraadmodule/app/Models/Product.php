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

    public function warehouses1()
    {
        return $this->belongsToMany(Warehouse::class, 'item_quantity_in_warehouses', 'product_id', 'warehouse_id');
    }

}
