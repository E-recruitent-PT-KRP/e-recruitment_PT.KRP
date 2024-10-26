@component('mail::message')
# Halo, {{ $notifiable->name }}! 👋

Terima kasih telah membuat akun di **PT Karya Rama Perkasa**. Kami senang Anda bergabung bersama kami!

Untuk melanjutkan, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:

@component('mail::button', ['url' => $verificationUrl, 'color' => 'success'])
Verifikasi Email Anda
@endcomponent

Jika Anda tidak merasa membuat akun, abaikan email ini. Alamat email Anda tetap aman dan tidak akan digunakan tanpa persetujuan Anda.

Terima kasih,  
**PT Karya Rama Perkasa**
@endcomponent
