<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'catatan_pembelian',
        'id_member',
        'no_invoice',
        'courier_detail'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pembayaran() {
        return $this->hasMany(Pembayaran::class, 'id_order', 'id');
    }

    public function produk_dikirim() {
        return $this->hasMany(ProdukDikirim::class, 'id_order', 'id');
    }
    
    public function member() {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }


}
