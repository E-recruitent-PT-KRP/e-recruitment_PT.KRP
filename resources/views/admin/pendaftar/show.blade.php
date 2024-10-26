@extends('layoutadmin.main')

@section('content')
    <div class="container">
        <h1>Detail Pelamar</h1>

        <div class="card">
            <div class="card-header bg-primary pb-0">
                <h4 class="text-white">Informasi Pelamar</h4>
                <div class="card-body text-white py-0">
                    <p><strong>Tanggal Tes:</strong>
                        {{ $pendaftar->tanggal_tes
                            ? \Carbon\Carbon::parse($pendaftar->tanggal_tes)->format('d-m-Y H:i')
                            : 'Belum dijadwalkan' }}
                    </p>
                    <p><strong>Tanggal Interview:</strong>
                        {{ $pendaftar->tanggal_interview
                            ? \Carbon\Carbon::parse($pendaftar->tanggal_interview)->format('d-m-Y H:i')
                            : 'Belum dijadwalkan' }}
                    </p>
                    <p><strong>Tanggal MCU:</strong>
                        {{ $pendaftar->tanggal_mcu
                            ? \Carbon\Carbon::parse($pendaftar->tanggal_mcu)->format('d-m-Y H:i')
                            : 'Belum dijadwalkan' }}
                    </p>

                </div>
            </div>

            <div class="row">
                <!-- Card Pertama -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Profil Pelamar</h3>

                            <img src="{{ asset('images/' . $pelamar->profile_picture) }}" alt="Foto Pelamar"
                                style="width:150px; height:auto;"><br><br>
                            {{-- <p><strong>ID:</strong> {{ $pendaftar->id }}</p> --}}
                            <p><strong>Nama:</strong> {{ $pendaftar->name }}</p>
                            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $pelamar->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d-F-Y') }} </p>
                            <p><strong>Jenis Kelamin:</strong> {{ $pelamar->jenis_kelamin }}</p>
                            <p><strong>Tinggi Badan:</strong> {{ $pelamar->tinggi_badan }}</p>
                            <p><strong>Berat Badan:</strong> {{ $pelamar->berat_badan }}</p>
                            <p><strong>Nomor HP:</strong> {{ $pelamar->no_hp }}</p>
                            <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
                            <p><strong>Pekerjaan Yang Didaftar:</strong> {{ $pendaftar->job->job_name }}</p>
                            <p><strong>Tanggal Pendaftaran:</strong> {{ $pendaftar->application_date }}</p>
                            <p><strong>Status:</strong> {{ $pendaftar->status }}</p>

                            <!-- Tombol Aksi Ubah Status -->
                            <div class="btn-group" role="group" aria-label="Aksi Status">
                                <!-- Form Proses Tes -->
                                <form action="{{ route('pendaftar.tes', $pendaftar->id) }}" method="POST"
                                    style="display:inline;" class="mx-2" id="tesForm">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="btn btn-warning" id="showDateTimeForm">Proses Tes</button>

                                    <!-- Form Input Tanggal dan Waktu untuk Tes -->
                                    <div id="dateTimeInput"
                                        style="display: none; border: 1px solid #000; border-radius: 8px;"
                                        class="my-4 px-4 py-4">
                                        <label for="tanggal_tes">Tanggal Tes:</label>
                                        <input type="date" name="tanggal_tes" id="tanggal_tes" required>

                                        <label for="waktu_tes">Waktu Tes:</label>
                                        <input type="time" name="waktu_tes" id="waktu_tes" required>

                                        <button type="submit" class="btn btn-success my-2">Kirim</button>
                                        <button type="button" class="btn btn-secondary" id="cancelButton">Batal</button>
                                    </div>
                                </form>

                                <!-- Form Proses Interview -->
                                <form action="{{ route('pendaftar.interview', $pendaftar->id) }}" method="POST"
                                    style="display:inline;" class="mx-2" id="interviewForm">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="btn btn-warning" id="showInterviewDateTimeForm">Proses
                                        Interview</button>

                                    <!-- Form Input Tanggal dan Waktu untuk Interview -->
                                    <div id="interviewDateTimeInput"
                                        style="display: none; border: 1px solid #000; border-radius: 8px;"
                                        class="my-4 px-4 py-4">
                                        <label for="tanggal_interview">Tanggal Interview:</label>
                                        <input type="date" name="tanggal_interview" id="tanggal_interview" required>

                                        <label for="waktu_interview">Waktu Interview:</label>
                                        <input type="time" name="waktu_interview" id="waktu_interview" required>

                                        <button type="submit" class="btn btn-success my-2">Kirim</button>
                                        <button type="button" class="btn btn-secondary"
                                            class="cancelButtonInterview">Batal</button>
                                    </div>
                                </form>

                                <!-- Form Proses MCU -->
                                <form action="{{ route('pendaftar.mcu', $pendaftar->id) }}" method="POST"
                                    style="display:inline;" class="mx-2" id="mcuForm">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="btn btn-warning" id="showMcuDateTimeForm">Proses
                                        MCU</button>

                                    <!-- Form Input Tanggal dan Waktu untuk MCU -->
                                    <div id="mcuDateTimeInput"
                                        style="display: none; border: 1px solid #000; border-radius: 8px;"
                                        class="my-4 px-4 py-4">
                                        <label for="tanggal_mcu">Tanggal MCU:</label>
                                        <input type="date" name="tanggal_mcu" id="tanggal_mcu" required>

                                        <label for="waktu_mcu">Waktu MCU:</label>
                                        <input type="time" name="waktu_mcu" id="waktu_mcu" required>

                                        <button type="submit" class="btn btn-success my-2">Kirim</button>
                                        <button type="button" class="btn btn-secondary"
                                            class="cancelButtonMcu">Batal</button>
                                    </div>
                                </form>

                                <form action="{{ route('pendaftar.terima', $pendaftar->id) }}" method="POST"
                                    style="display:inline;" class="mx-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Diterima?')">Diterima</button>
                                </form>

                                {{-- <form action="{{ route('pendaftar.tolak', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Ditolak?')">Ditolak</button>
                            </form> --}}
                                <form action="{{ route('pendaftar.tolak', $pendaftar->id) }}" method="POST"
                                    style="display:inline;" class="mx-2" id="rejectionForm">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="btn btn-danger" id="rejectButton">Ditolak</button>

                                    <!-- Dropdown yang tersembunyi -->
                                    <div id="rejectionDropdown" style="display:none; margin-top: 10px;">
                                        <label for="reason">Pilih Alasan Penolakan:</label>
                                        <select name="keterangan" id="reason" required>
                                            <option value="" disabled selected>Pilih alasan...</option>
                                            <option value="Gagal Tes Kompetensi">Gagal Tes Kompetensi</option>
                                            <option value="Gagal Wawancara">Gagal Tes Wawancara</option>
                                            <option value="Gagal MCU">Gagal Tes MCU</option>
                                            <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                            <option value="Tidak Sesuai Kualifikasi">Tidak Sesuai Kualifikasi</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="submitButton"
                                        style="display:none;">Kirim</button>
                                </form>

                                <form action="" style="display:inline;" class="mx-2">
                                    <a href="{{ route('pendaftar.showCv', $pendaftar->id) }}"
                                        class="btn btn-primary">Lihat
                                        CV</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Kedua -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Pendidikan Terakhir</h3>
                            <p><strong>Nama Sekolah:</strong> {{ $pelamar->nama_institusi }}</p>
                            <p><strong>jenjang Pendidikan:</strong> {{ $pelamar->jenjang_pendidikan }}</p>
                            <p><strong>Jurusan:</strong> {{ $pelamar->jurusan }}</p>
                            <p><strong>Tahun Masuk dan Lulus:</strong> {{ $pelamar->tahun_masuk }} -
                                {{ $pelamar->tahun_lulus }}</p>
                        </div>
                    </div>
                    <!-- Card Kedua -->

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Alamat Sesuai KTP</h3>
                            <p><strong>Negara:</strong> {{ $pelamar->negara }}</p>
                            <p><strong>Provinsi:</strong> {{ $pelamar->provinsi }}</p>
                            <p><strong>Kota/Kabupaten:</strong> {{ $pelamar->kota }}</p>
                            <p><strong>Kecamatan:</strong> {{ $pelamar->kecamatan }}</p>
                            <p><strong>Kelurahan:</strong> {{ $pelamar->kelurahan }}</p>
                            <p><strong>RT:</strong> {{ $pelamar->rt }}</p>
                            <p><strong>RW:</strong> {{ $pelamar->rw }}</p>
                            <p><strong>Alamat:</strong> {{ $pelamar->alamat_ktp }}</p>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Tombol Kembali ke halaman data pelamar -->
            <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>

    <!-- JavaScript untuk Menampilkan dan Menyembunyikan Form -->
    <script>
        document.getElementById('showDateTimeForm').onclick = function() {
            var form = document.getElementById('dateTimeInput');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };

        document.getElementById('showInterviewDateTimeForm').onclick = function() {
            var form = document.getElementById('interviewDateTimeInput');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };

        document.getElementById('showMcuDateTimeForm').onclick = function() {
            var form = document.getElementById('mcuDateTimeInput');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };

        // Fungsi untuk menyembunyikan form ketika tombol batal diklik
        document.querySelectorAll('.cancelButtonInterview').forEach(function(button) {
            button.onclick = function() {
                document.getElementById('interviewDateTimeInput').style.display = 'none';
            };
        });

        document.querySelectorAll('.cancelButtonMcu').forEach(function(button) {
            button.onclick = function() {
                document.getElementById('mcuDateTimeInput').style.display = 'none';
            };
        });
    </script>

    <script>
        document.getElementById('rejectButton').onclick = function() {
            document.getElementById('rejectionDropdown').style.display = 'block';
            document.getElementById('submitButton').style.display = 'inline-block';
        };
    </script>
@endsection
