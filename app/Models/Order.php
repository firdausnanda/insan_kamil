<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'id_user',
        'harga_total',
        'jumlah_produk_total',
        'courier',
        'biaya_pengiriman',
        'origin',
        'destination',
        'no_resi',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}