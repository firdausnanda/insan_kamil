<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsappMessage;
use App\Channels\WhatsappChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccesful extends Notification
{
    use Queueable;

    protected $user;
    protected $bayar;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $bayar)
    {
        $this->user = $user;
        $this->bayar = $bayar;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toWhatsapp($notifiable)
    {
        $message = "Hai, " . $this->user->name . "!\n\n";
        $message .= "Terima kasih telah melakukan pesanan sebesar " . rupiah2($this->bayar) . " di Penerbit Insan Kamil. Pesanan Anda telah kami terima dan sedang menunggu konfirmasi pembayaran. Kami akan mengirimkan detail lebih lanjut setelah pembayaran dikonfirmasi. Selamat berbelanja!\n\n";
        $message .= "Jika ada kendala atau informasi lebih lanjut, silahkan hubungi kami di 0857-2855-7776";

        return (new WhatsappMessage())->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->user->name,
            'total_pembayaran' => $this->bayar,
            'messages' => 'Order Successful'
        ];
    }
}
