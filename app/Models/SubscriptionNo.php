<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionNo extends Model
{
    use HasFactory;

    protected $table = 'subscription_no';
    protected $fillable = ['no_hp'];
}
