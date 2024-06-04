<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'productnummer',
        'name',
        'description',
        'category',
    ];
}
