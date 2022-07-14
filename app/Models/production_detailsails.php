<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class production_detailsails extends Model
{
    use HasFactory;


    
    protected $fillable = [
        'product_id',
        'Depolama_Alani',
        'Ekran_Boyutu',
        'RAM',
        'Yazar',
        'Çevirmen',
        'Sayfa_Sayisi',
        'Baski_Sayisi',
        'Dil',
        'İlk_Baski_Yili',
        'created_at',
        'updated_at',
    ];
}
