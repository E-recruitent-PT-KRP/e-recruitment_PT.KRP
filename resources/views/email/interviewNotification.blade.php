@component('mail::message')
# Halo, {{ $pendaftar->name }}! 🎉

Terima kasih telah mendaftar sebagai **{{ $pendaftar->job->job_name }}** di perusahaan kami. Kami memiliki kabar penting terkait proses pendaftaran Anda.

---

### Status Pendaftaran Diperbarui 🔔

Pendaftaran Anda kini memiliki status **"Interview"**. Berikut adalah informasi lengkap mengenai jadwal interview Anda:

@component('mail::panel')
**Tanggal Interview:**  
📅 **{{ \Carbon\Carbon::parse($pendaftar->tanggal_interview)->format('l, d F Y - H:i') }}**
@endcomponent

---

#### Dokumen yang Wajib Dibawa:
Mohon untuk membawa berkas-berkas berikut dalam bentuk hardcopy:
- **Curriculum Vitae (CV)**
- **Surat Keterangan Catatan Kepolisian (SKCK)**
- **Fotokopi NPWP**
- **Fotokopi KTP**

Harap datang tepat waktu dan mempersiapkan diri dengan baik. Kenakan pakaian yang rapi untuk interview.

@component('mail::button', ['url' => config('app.url') . '/dashboard', 'color' => 'success'])
Lihat Jadwal di Aplikasi
@endcomponent

@component('mail::subcopy')
Jaga kesehatan dan tetap semangat untuk interview!
@endcomponent

Salam Hormat,  
**HRD PT Karya Rama Perkasa**
@endcomponent
