<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $pendaftar;

    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->greeting('Halo, ' . $this->pendaftar->name . '!')
    //         ->subject('PT Karya Rama Perkasa')
    //         ->line('Pendaftaran anda sebagai : '. $this->pendaftar->job->job_name)
    //         ->line('Selamat Anda diterima pada PT Karya Rama Perkasa')
    //         ->line('Silakan cek aplikasi untuk informasi lebih lanjut.')
    //         ->line('Terima kasih!');
    // }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('PT Karya Rama Perkasa')
            ->markdown('email.acceptedNotification', [
                'pendaftar' => $this->pendaftar
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
