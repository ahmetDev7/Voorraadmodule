<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'serialnumber',
        'name',
        'description',
        'category',
        'warehouse_id',
    ];
}
