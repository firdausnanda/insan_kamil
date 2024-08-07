<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity, Impersonate, Notifiable;

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
        'alamat',
        'provinsi',
        'kota',
        'desa',
        'status',
        'id_member',
        'kode_pos',
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

    public function routeNotificationForWhatsapp()
    {
      return $this->no_telp;
    }

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
    
    public function province()
    {
      return $this->belongsTo(Province::class, 'provinsi', 'id');
    }

    public function city()
    {
      return $this->belongsTo(City::class, 'kota', 'id');
    }

    public function district()
    {
      return $this->belongsTo(Subdistrict::class, 'desa', 'id');
    }
    
    public function member()
    {
      return $this->belongsTo(Member::class, 'id_member', 'id');
    }
}
