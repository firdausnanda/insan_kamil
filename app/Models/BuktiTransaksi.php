<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransaksi extends Model
{
    use HasFactory;

    protected $table = 'bukti_transfer';

    protected $fillable = [
        'order_id',
        'gambar',
        'status',
        'nama_rekening',
        'no_rekening',
        'transfer_ke',
        'tgl_transfer',
    ];

}
