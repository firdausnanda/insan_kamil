<?php

namespace App\Channels;

use App\Helpers\Wa;
use Illuminate\Notifications\Notification;

class WhatsappChannel
{
  public function send($notifiable, Notification $notification)
  {
    $message = $notification->toWhatsapp($notifiable);
    $to = $notifiable->routeNotificationFor('Whatsapp');
    return Wa::send($to, $message->content);
  }
}
