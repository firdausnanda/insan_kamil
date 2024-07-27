<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'penerbit';

    protected $fillable = [
        'nama_penerbit',
        'slug',
        'gambar',
    ];

    protected static function boot() {
        parent::boot();
    
        static::creating(function ($penerbit) {
            $penerbit->slug = Str::slug($penerbit->nama_penerbit);
        });
    }
}
