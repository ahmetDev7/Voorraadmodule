<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSerialNumber extends Model
{
    protected $fillable = ['product_id', 'serialnumber', 'productnumber',];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function itemQuantityInWarehouses()
    {
        return $this->hasOne(ItemQuantityInWarehouses::class, 'serial_number_id');
    }
    public function warehouse()
    {
        return $this->hasOneThrough(Warehouse::class, ItemQuantityInWarehouses::class, 'serial_number', 'id', 'serialnumber', 'warehouse_id');
    }
}
