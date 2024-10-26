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

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->greeting('Halo, ' . $this->pendaftar->name . '!')
    //         ->subject('Notifikasi Tes')
    //         ->line('Pendaftaran anda sebagai : '. $this->pendaftar->job->job_name)
    //         ->line('Status Anda telah diperbarui menjadi "Tes".')
    //         ->line('Jadwal Tes Anda Adalah Tanggal :' . $this->pendaftar->tanggal_tes )
    //         ->line('aja klalen coblos Ahmad lutfi.')
    //         ->line('Silakan cek aplikasi untuk informasi lebih lanjut.')
    //         ->line('Terima kasih!');
    // }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notifikasi Tes')
            ->markdown('email.tesNotification', [
                'pendaftar' => $this->pendaftar
            ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
