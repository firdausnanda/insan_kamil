<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    use HasFactory;

    protected $table = 'alamat_user';

    protected $fillable = [
        'id_user',
        'nama_penerima',
        'alamat_penerima',
        'kota_penerima',
        'provinsi_penerima',
        'desa_penerima',
        'no_telp_penerima',
        'kode_pos',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_penerima', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'kota_penerima', 'id');
    }

    public function district()
    {
        return $this->belongsTo(Subdistrict::class, 'desa_penerima', 'id');
    }
}
