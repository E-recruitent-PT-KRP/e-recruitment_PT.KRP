@component('mail::message')
# Selamat, {{ $pendaftar->name }}! 🎉

Kami dengan senang hati menginformasikan bahwa Anda telah **DITERIMA** sebagai **{{ $pendaftar->job->job_name }}** di **PT Karya Rama Perkasa**! Selamat bergabung dengan tim kami!

---

### Langkah Selanjutnya 🚀

Berikut adalah beberapa hal yang perlu Anda persiapkan untuk memulai perjalanan Anda bersama kami:

1. **Persiapan Dokumen**  
   Pastikan semua dokumen penting seperti KTP, NPWP, dan dokumen pendukung lainnya sudah siap untuk proses administrasi lebih lanjut.

2. **Informasi Onboarding**  
   Tim HR kami akan segera menghubungi Anda untuk memberikan informasi lebih lanjut mengenai jadwal dan prosedur onboarding. Mohon tetap memeriksa email atau aplikasi kami untuk pembaruan.

3. **Pertemuan Pertama di Kantor**  
   Kami ingin Anda merasa nyaman dan terhubung sejak hari pertama! Anda akan dijadwalkan untuk orientasi dengan tim dan akan mendapatkan pengenalan tentang lingkungan kerja.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Lihat Detail Posisi Anda
@endcomponent

---

### Pesan dari Kami

Selamat atas pencapaian ini! Kami berharap Anda siap membawa energi positif dan berkontribusi dalam tim kami. Semoga ini menjadi awal dari perjalanan yang sukses dan inspiratif bagi Anda di **PT Karya Rama Perkasa**.

@component('mail::subcopy')
Jika ada pertanyaan, jangan ragu untuk menghubungi tim HR kami. Kami siap membantu Anda!
@endcomponent

Salam Hangat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
