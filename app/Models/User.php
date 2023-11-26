<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'username',
        'email',
        'google_id',
        'password',
        'avatar',
        'no_telp',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
      if ($activity->causer_id) {
        $activity->description = "{$activity->causer->name} {$eventName} on {$activity->subject->name}";
      } else {
        $activity->description = "{$activity->subject->name} just signed up";
      }
    }
  
    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults()
        ->logOnly(['name', 'username', 'email', 'telp', 'is_disabled'])
        ->logOnlyDirty(true)
        ->logUnguarded();
    }
}
