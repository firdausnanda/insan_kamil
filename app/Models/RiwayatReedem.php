<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatReedem extends Model
{
    use HasFactory;

    protected $table = 'riwayat_reedem';

    protected $fillable = [
        'id_user',
        'id_reward',
        'nama',
        'point_total',
        'harga_total',
        'deskripsi',
        'gambar',
        'keterangan',
        'status',
        'no_rekening',
        'nama_pemilik',
        'ktp',
    ];

    public function reward()
    {
        return $this->belongsTo(RewardPoint::class, 'id_reward', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
