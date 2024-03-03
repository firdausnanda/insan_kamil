<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon';

    protected $fillable = [
        'nama',
        'keterangan',
        'diskon',
        'mulai_diskon',
        'selesai_diskon',
        'status',
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'diskon_produk', 'id_diskon', 'id_produk')->withTimestamps();
    }
}
