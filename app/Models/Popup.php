<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $table = 'popup';

    protected $fillable = [
        'gambar',
        'judul',
        'diskon',
        'keterangan',
        'status'
    ];
}
