<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsappMessage;
use App\Channels\WhatsappChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PesanWhatsApp extends Notification
{
    use Queueable;
    protected $pesan;

    /**
     * Create a new notification instance.
     */
    public function __construct($pesan)
    {
        $this->pesan = $pesan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsappChannel::class];
    }

    /**
     * Get the whatsapp representation of the notification.
     */
    public function toWhatsapp($notifiable)
    {        
        return (new WhatsappMessage())->content($this->pesan);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->pesan
        ];
    }
}
