@component('mail::message')
# Halo, {{ $pendaftar->name }},

Terima kasih telah meluangkan waktu untuk mengikuti proses seleksi di **PT Karya Rama Perkasa**. Kami menghargai setiap usaha dan minat yang Anda tunjukkan terhadap posisi **{{ $pendaftar->job->job_name }}**.

---

## Keterangan : {{ $pendaftar->keterangan }},

### Informasi Status Pendaftaran 🔔

Kami ingin menginformasikan bahwa pendaftaran Anda untuk posisi tersebut saat ini **DITOLAK**. Keputusan ini tidak mencerminkan nilai dan potensi Anda, dan kami percaya bahwa Anda akan menemukan kesempatan yang lebih sesuai di masa mendatang.

Jangan ragu untuk mengikuti kami di media sosial untuk mendapatkan informasi tentang lowongan kerja dan acara perusahaan kami yang akan datang.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Kunjungi Website Kami
@endcomponent

@component('mail::subcopy')
Kami berharap yang terbaik untuk Anda dalam pencarian karir Anda selanjutnya.
@endcomponent

Salam Hormat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
