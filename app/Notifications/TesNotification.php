<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TesNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pendaftar;

    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Halo, ' . $this->pendaftar->name . '!')
            ->subject('Notifikasi Tes')
            ->line('Status Anda telah diperbarui menjadi "Tes".')
            ->line('Silakan cek aplikasi untuk informasi lebih lanjut.')
            ->line('Terima kasih!');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
