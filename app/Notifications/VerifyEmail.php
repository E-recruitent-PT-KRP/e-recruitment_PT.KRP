<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello! cukimay')
            ->line('Please verify your email address. untuk melanjutkan pendaftaran akun pada PT Karya Rama Perkasa')
            ->action('Verify Email', $notifiable->verificationUrl())
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            // Data yang ingin disimpan di database
        ];
    }
}
