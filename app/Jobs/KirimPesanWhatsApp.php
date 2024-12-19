<?php

namespace App\Jobs;

use App\Models\SubscriptionNo;
use App\Notifications\PesanWhatsApp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;
class KirimPesanWhatsApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    protected $no_hp;
    protected $pesan;

    /**
     * Create a new job instance.
     */
    public function __construct($no_hp, $pesan)
    {
        $this->no_hp = $no_hp;
        $this->pesan = $pesan;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Illuminate\Support\Facades\Notification::route('Whatsapp', $this->no_hp)
            ->notify(new PesanWhatsApp($this->pesan));
    }
}

