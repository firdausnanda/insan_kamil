<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Blog extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'blog';

    protected $fillable = [
        'judul',
        'gambar',
        'isi',
        'status',
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
}
