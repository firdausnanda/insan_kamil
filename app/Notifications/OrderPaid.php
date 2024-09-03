<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsappMessage;
use App\Channels\WhatsappChannel;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaid extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        $message = "Hallo ada pelanggan yang mengupload bukti transaksi\n\n";
        $message .= "No. Rekening : " . $this->order->bukti_transaksi[0]->no_rekening . "\n";
        $message .= "Nama Rekening : " . $this->order->bukti_transaksi[0]->nama_rekening . "\n";
        $message .= "Transfer ke : " . $this->order->bukti_transaksi[0]->transfer_ke . "\n";
        $message .= "Link : " . asset('storage/bukti-transaksi/' . $this->order->bukti_transaksi[0]->gambar) . "\n";

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
            'order_id' => $this->order->id,
            'no_rekening' => $this->order->no_rekening,
            'nama_rekening' => $this->order->nama_rekening,
            'transfer_ke' => $this->order->transfer_ke,
            'messages' => 'Order Uploaded Successful'
        ];
    }
}
