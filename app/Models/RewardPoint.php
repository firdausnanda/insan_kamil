<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    use HasFactory;

    protected $table = 'point_reward';

    protected $fillable = [
        'nama',
        'point_total',
        'harga_total',
        'deskripsi',
        'gambar',
        'kuota',
        'is_active',
    ];
}
