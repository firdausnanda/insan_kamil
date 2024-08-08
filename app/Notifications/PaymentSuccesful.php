<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsappMessage;
use App\Channels\WhatsappChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccesful extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', WhatsappChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }


    public function toWhatsapp($notifiable)
    {
        $message = "Hai, " . $this->user->name . "!\n\n";
        $message .= "Selamat pembayaran Anda berhasil! Kami telah menerima pembayaran Anda dan pesanan Anda sedang diproses. Terima kasih telah memilih Insan Kamil. Selamat berbelanja!\n\n";
        $message .= "Jika ada kendala atau informasi lebih lanjut, silahkan hubungi kami di 0857-2855-7776";

        return (new WhatsappMessage())->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'name' => $this->user->name,
            'messages' => 'Payment Successful'
        ];
    }
}
