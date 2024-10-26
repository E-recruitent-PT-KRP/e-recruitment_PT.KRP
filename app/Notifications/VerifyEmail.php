<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->greeting('Hello! cukimay')
    //         ->line('Please verify your email address. untuk melanjutkan pendaftaran akun pada PT Karya Rama Perkasa')
    //         ->action('Verify Email', $notifiable->verificationUrl())
    //         ->line('Thank you for using our application!');
    // }

    // public function toMail($notifiable)
    // {
    //     // Menggunakan metode verificationUrl yang telah didefinisikan
    //     $verificationUrl = $this->verificationUrl($notifiable);

    //     return (new MailMessage)
    //         ->greeting('Hello, ' . $notifiable->name . '!')
    //         ->subject('Verifikasi Email PT Karya Rama Perkasa')
    //         ->line('Terima kasih telah membuat akun pada PT Karya Rama Perkasa! Klik tombol di bawah untuk memverifikasi email Anda.')
    //         ->action('Verifikasi Email Anda', $verificationUrl)
    //         ->line('Jika Anda tidak mendaftar, abaikan email ini.');
    // }

    public function toMail($notifiable)
    {
        // Menggunakan metode verificationUrl untuk menghasilkan link verifikasi
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email PT Karya Rama Perkasa')
            ->markdown('email.verifEmail', [
                'notifiable' => $notifiable,
                'verificationUrl' => $verificationUrl
            ]);
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    public function toArray($notifiable)
    {
        return [
            // Data yang ingin disimpan di database
        ];
    }
}
