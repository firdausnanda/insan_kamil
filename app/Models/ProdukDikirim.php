<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDikirim extends Model
{
    use HasFactory;

    protected $table = 'produk_dikirim';
    protected $fillable = [
        'id_order',
        'id_produk',
        'harga_jual',
        'jumlah_produk',
    ];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
