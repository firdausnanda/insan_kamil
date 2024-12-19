<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubscriptionNo extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'subscription_no';
    protected $fillable = ['no_hp'];
}
