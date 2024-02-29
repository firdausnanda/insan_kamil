<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMenu extends Model
{
    use HasFactory;

    protected $table = 'group_menu';

    protected $fillable = [
        'nama',
        'deskripsi',
        'status'
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'group_menu_produk', 'id_group_menu', 'id_produk')->withTimestamps();
    }
}
