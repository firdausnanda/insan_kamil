<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropshipMaster extends Model
{
    use HasFactory;

    protected $table = 'dropship_master';

    protected $fillable = [
        'id_user',
        'nama_pengirim',
        'no_telp_pengirim',
        'email_pengirim',
        'alamat_penerima',
        'kota_penerima',
        'provinsi_penerima',
        'desa_penerima',
        'no_telp_penerima',
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
