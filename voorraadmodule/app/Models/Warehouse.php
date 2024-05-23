<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'street',
        'housenumber',
        'zipcode',
        'city',
        'country'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'item_quantity_in_warehouses', 'warehouse_id', 'product_id')
                    ->withPivot('quantity');
    }

}