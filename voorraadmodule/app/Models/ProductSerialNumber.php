<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductSerialNumber extends Model
{
    protected $fillable = [
        'product_id',
        'serialnumber',
        'productnumber',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function itemQuantityInWarehouses()
    {
        return $this->belongsTo(ItemQuantityInWarehouses::class);
    }

    public function warehouse() 
    {
        return $this->belongsTo(Warehouse::class);
    }


}
