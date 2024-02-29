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
        'id_bahasa',
        'kode_produk',
        'nama_produk',
        'berat_produk',
        'ukuran_produk',
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

    public function bahasa()
    {
        return $this->belongsTo(Bahasa::class, 'id_bahasa', 'id');
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

    public function produk_dikirim()
    {
        return $this->hasMany(ProdukDikirim::class, 'id_produk', 'id');
    }
    
    public function menu()
    {
        return $this->belongsToMany(GroupMenu::class, 'group_menu_produk', 'id_produk', 'id_group_menu')->withTimestamps();
    }
}
