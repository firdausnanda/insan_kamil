<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    
    protected $fillable = [
        'harga_awal',
        'diskon',
        'harga_akhir',
        'mulai_diskon',
        'selesai_diskon',
    ];

    protected static function booted()
    {
        // Get harga
        $harga = Harga::whereNotNull('selesai_diskon')->get();

        // Remove diskon when expired
        foreach ($harga as $k => $v) {
            
            if ($v->diskon && $v->mulai_diskon < now()) {
                $harga_akhir = $v->harga_awal - $v->diskon;
                $data = Harga::where('id', $v->id)->update([
                    'harga_akhir' => $harga_akhir,
                ]);
            }

            if ($v->selesai_diskon && $v->selesai_diskon < now()) {
                $harga_akhir = $v->diskon + $v->harga_akhir;
                $data = Harga::where('id', $v->id)->update([
                    'harga_awal' => $v->harga_awal,
                    'diskon' => 0,
                    'harga_akhir' => $harga_akhir,
                    'selesai_diskon' => null,
                    'mulai_diskon' => null,
                ]);
            }
        }
    }
}
