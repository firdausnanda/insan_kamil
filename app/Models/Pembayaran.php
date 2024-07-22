<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Pembayaran extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_order',
        'status_pembayaran',
        'snap_token',
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

    protected static function booted()
    {
        $expired = Pembayaran::whereBetween('created_at', [Carbon::yesterday(), Carbon::now()->addDays(2)])->get();

        foreach ($expired as $value) {
            if ($value->created_at->addDays(1) < now() && $value->status_pembayaran != 2) {
                Pembayaran::where('id', $value->id)->update([
                    'status_pembayaran' => 3,
                ]);
            }
        }
    }
}
