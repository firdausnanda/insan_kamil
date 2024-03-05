<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Dropship extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'dropship';

    protected $fillable = [
        'id_user',
        'id_order',
        'nama_pengirim',
        'no_telp_pengirim',
        'email_pengirim',
        'nama_penerima',
        'alamat_penerima',
        'kota_penerima',
        'provinsi_penerima',
        'desa_penerima',
        'no_telp_penerima',
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
