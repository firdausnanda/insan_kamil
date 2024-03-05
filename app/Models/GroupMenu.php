<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class GroupMenu extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'group_menu';

    protected $fillable = [
        'nama',
        'deskripsi',
        'status'
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

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'group_menu_produk', 'id_group_menu', 'id_produk')->withTimestamps();
    }
}
