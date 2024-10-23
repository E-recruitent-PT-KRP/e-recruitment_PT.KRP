@extends('layoutadmin.main')

@section('content')
<div class="container">
    <h1>Detail Pelamar</h1>

    <div class="card">
        <div class="card-header">
            <h4>Informasi Pelamar</h4>
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
                        <p><strong>Tempat, Tanggal Lahir:</strong> {{ $pelamar->tempat_lahir }}, {{
                            \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d-F-Y') }} </p>
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
                            <form action="{{ route('pendaftar.tes', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Proses?')">Proses Tes</button>
                            </form>

                            <form action="{{ route('pendaftar.interview', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Proses?')">Interview</button>
                            </form>

                            <form action="{{ route('pendaftar.mcu', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Proses?')">MCU</button>
                            </form>

                            <form action="{{ route('pendaftar.acc', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi ACC?')">ACC</button>
                            </form>

                            <form action="{{ route('pendaftar.tolak', $pendaftar->id) }}" method="POST"
                                style="display:inline;" class="mx-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Ditolak?')">Ditolak</button>
                            </form>
                            <form action="" style="display:inline;" class="mx-2">
                                <a href="{{ route('cv.show', ['id' => $pelamar->id]) }}" class="btn btn-primary">Lihat
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
</div>
@endsection