<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_name',
        'type',
        'description',
        'image_name',
        'sale_price',
        'quantity',
        'created_at',
        'updated_at',
    ];

    

}


