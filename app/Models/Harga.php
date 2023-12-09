<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    
    protected $fillable = [
        'id_produk',
        'harga_awal',
        'diskon',
        'harga_akhir',
    ];
}
