<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Uuids;

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

    public function produk_dikirim() {
        return $this->hasMany(ProdukDikirim::class, 'id_order', 'id');
    }
}
