<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, Uuids, LogsActivity;

    protected $table = 'order';

    protected $fillable = [
        'id_user',
        'harga_total',
        'jumlah_produk_total',
        'courier',
        'biaya_pengiriman',
        'origin',
        'destination',
        'no_resi',
        'status',
        'catatan_pembelian',
        'id_member',
        'no_invoice',
        'courier_detail',
        'is_flash',
        'total_point'
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if ($activity->causer_id) {
            $activity->description = "{$activity->causer->name} {$eventName} on {$activity->subject->nama}";
        } else {
            $activity->description = "{$activity->subject->nama} ";
        }
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable(true)
            ->logOnlyDirty(true)
            ->logUnguarded();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_order', 'id');
    }

    public function produk_dikirim()
    {
        return $this->hasMany(ProdukDikirim::class, 'id_order', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function bukti_transaksi()
    {
        return $this->hasMany(BuktiTransaksi::class, 'order_id', 'id');
    }

    protected static function booted()
    {
        // $order = Order::where('status', '>=', 2)->where('status', '!=', 6)->get();

        // foreach ($order as $o) {
        //     $totalBelanja = $o->pembayaran()->sum('harga_jual');
        //     if ($totalBelanja >= 50000) {
        //         $poin = floor($totalBelanja / 50000);
        //         $o->total_point = $poin;
        //         $o->save();
        //     }
        // }

        // static::updating(function ($order) {
        //     $totalBelanja = $order->pembayaran()->sum('harga_jual');
        //     if ($totalBelanja >= 50000) {
        //         $poin = floor($totalBelanja / 50000);
        //         $order->total_point = $poin;
        //     }
        // });
    }
}
