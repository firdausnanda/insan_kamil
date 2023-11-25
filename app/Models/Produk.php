<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    
    protected $fillable = [
        'id_kategori',
        'id_penerbit',
        'id_harga',
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
        'pengarang'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function harga()
    {
        return $this->belongsTo(Harga::class, 'id_harga', 'id');
    }
}
