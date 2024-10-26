@component('mail::message')
# Halo, {{ $pendaftar->name }}! 🎉

Terima kasih telah mendaftar sebagai **{{ $pendaftar->job->job_name }}** di perusahaan kami. Kami memiliki kabar penting terkait proses pendaftaran Anda.

---

### Status Pendaftaran Diperbarui 🔔

Pendaftaran Anda kini memiliki status **"MCU"**. Berikut adalah informasi lengkap mengenai jadwal Medical Check-Up Anda:

@component('mail::panel')
**Tanggal Medical Check-Up:**  
📅 **{{ \Carbon\Carbon::parse($pendaftar->tanggal_interview)->format('l, d F Y - H:i') }}**
@endcomponent

---

### Pesan dan Saran untuk Persiapan Medical Check-Up

1. **Tidur yang Cukup**  
   Usahakan tidur minimal 7-8 jam sebelum jadwal MCU untuk hasil yang lebih akurat dan kondisi tubuh yang optimal.

2. **Perhatikan Pola Makan**  
   Hindari makanan berlemak, pedas, atau berkolesterol tinggi sehari sebelum pemeriksaan. Lebih baik konsumsi makanan yang sehat, terutama buah dan sayuran.

3. **Jangan Mengkonsumsi Kafein atau Rokok**  
   Hindari kafein (kopi, teh) dan rokok selama 24 jam sebelum pemeriksaan untuk menjaga stabilitas tekanan darah dan detak jantung.

4. **Puasa Sesuai Anjuran**  
   Jika diminta puasa, biasanya selama 8-12 jam sebelum MCU. Minum air putih diperbolehkan, namun hindari makanan atau minuman lainnya.

5. **Bawa Dokumen yang Diperlukan**  
   Jangan lupa untuk membawa dokumen pribadi yang diperlukan, seperti KTP, kartu kesehatan, dan lainnya sesuai permintaan.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Lihat Jadwal di Aplikasi
@endcomponent

@component('mail::subcopy')
Tetap jaga kesehatan dan semoga sukses dalam tes!
@endcomponent

Salam Hormat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
