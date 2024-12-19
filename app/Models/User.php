<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\SerializesModels;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity, Impersonate, Notifiable, IsMonitored;

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
    'earned_points',
    'used_points',
    'total_points',
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

  protected static function booted()
  {
    static::retrieved(function ($user) {
      $totalOrder = Order::where('id_user', $user->id)
        ->where('status', '>=', 2)
        ->where('status', '!=', 6)
        ->sum('total_point');

      User::where('id', $user->id)->update(['earned_points' => $totalOrder]);

      $totalPoint = $user->earned_points - $user->used_points;

      User::where('id', $user->id)->update(['total_points' => $totalPoint]);
    });


    // $user = User::whereHas('roles', function ($query) {
    //   $query->where('name', 'user');
    // })->get();

    // foreach ($user as $u) {
    //   $totalOrder = Order::where('id_user', $u->id)
    //     ->where('status', '>=', 2)
    //     ->where('status', '!=', 6)
    //     ->sum('total_point');

    //   User::where('id', $u->id)->update(['earned_points' => $totalOrder]);

    //   $totalPoint = $u->earned_points - $u->used_points;

    //   User::where('id', $u->id)->update(['total_points' => $totalPoint]);
    // }
  }
}
