@component('mail::message')
# Halo, {{ $pendaftar->name }}! 🎉

Terima kasih telah mendaftar sebagai **{{ $pendaftar->job->job_name }}** di perusahaan kami. Kami memiliki kabar penting terkait proses pendaftaran Anda.

---

### Status Pendaftaran Diperbarui 🔔

Pendaftaran Anda kini memiliki status **"Tes"**. Berikut adalah informasi lengkap mengenai jadwal tes Anda:

@component('mail::panel')
**Tanggal Tes:**  
📅 **{{ \Carbon\Carbon::parse($pendaftar->tanggal_tes)->format('l, d F Y - H:i') }}**
@endcomponent

---

Mohon untuk hadir tepat waktu dan mempersiapkan diri dengan baik. Jangan lupa membawa dokumen yang diperlukan dan mengenakan pakaian yang rapi.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Lihat Jadwal di Aplikasi
@endcomponent

@component('mail::subcopy')
Jangan Lupa Jaga Kesehatan dan Tetap Semangat!
@endcomponent

Salam Hormat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
