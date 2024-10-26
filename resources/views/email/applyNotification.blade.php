@component('mail::message')
# Halo, {{ $pendaftar->name }}! 🎉

Kami dengan senang hati menginformasikan bahwa lamaran Anda untuk posisi **{{ $pendaftar->job->job_name }}** di **PT Karya Rama Perkasa** telah kami terima! Terima kasih telah meluangkan waktu untuk mengajukan lamaran di perusahaan kami.

---

### Informasi Selanjutnya 🚀

Proses seleksi akan segera dimulai, dan tim kami sedang meninjau semua aplikasi yang masuk. Berikut adalah beberapa hal yang perlu Anda ketahui:

1. **Waktu Proses Seleksi**  
   Tim kami akan melakukan peninjauan dan akan menghubungi Anda dalam waktu dekat untuk memberitahukan langkah selanjutnya.

2. **Cek Status Lamaran**  
   Anda dapat selalu memeriksa status lamaran Anda melalui akun Anda di aplikasi kami.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Cek Status Lamaran Anda
@endcomponent
@component('mail::subcopy')
Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.
@endcomponent

Salam Hormat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
