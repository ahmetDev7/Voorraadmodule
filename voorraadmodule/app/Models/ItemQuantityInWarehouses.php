<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantityInWarehouses extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'serial_number_id',
        'warehouse_id',
        'quantity'
    ];

    public function iteminwarehouse()
    {
        return $this->belongsToMany(ItemQuantityInWarehouses::class, 'warehouse_id', 'product_id')
                    ->withPivot('quantity');
    }
}
