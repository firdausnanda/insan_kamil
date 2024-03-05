<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class ProdukDikirim extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'produk_dikirim';
    protected $fillable = [
        'id_order',
        'id_produk',
        'harga_jual',
        'jumlah_produk',
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

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function order_dibayar() {
        return $this->belongsTo(Order::class, 'id_order', 'id')->where('status', '>=', 2)->where('status', '<', 6);
    }
}
