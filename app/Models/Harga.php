<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    
    protected $fillable = [
        'id_produk',
        'harga_awal',
        'diskon',
        'harga_akhir',
        'selesai_diskon',
    ];

    protected static function booted()
    {
        // Get harga
        $harga = Harga::whereNotNull('selesai_diskon')->get();

        // Remove diskon when expired
        foreach ($harga as $k => $v) {
            if ($v->selesai_diskon < now()) {
                $harga_akhir = $v->diskon + $v->harga_akhir;
                $data = Harga::where('id', $v->id)->update([
                    'harga_awal' => $v->harga_awal,
                    'diskon' => 0,
                    'harga_akhir' => $harga_akhir,
                    'selesai_diskon' => null,
                ]);
            }
        }
    }
}
