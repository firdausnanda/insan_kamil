<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Produk extends Model
{
    use HasFactory, Rateable;

    protected $table = 'produk';

    protected $fillable = [
        'id_kategori',
        'id_penerbit',
        'id_harga',
        'id_stok',
        'kode_produk',
        'nama_produk',
        'berat_produk',
        'ukuran_produk',
        'bahasa',
        'isbn',
        'jenis_cover',
        'halaman_produk',
        'keterangan',
        'status',
        'pengarang',
        'catatan',
        'jenis_isi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function harga()
    {
        return $this->belongsTo(Harga::class, 'id_harga', 'id');
    }
    
    public function stok()
    {
        return $this->belongsTo(Stok::class, 'id_stok', 'id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
    
    public function gambar_produk()
    {
        return $this->hasMany(GambarProduk::class, 'id_produk', 'id');
    }
}
