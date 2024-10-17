@extends('layout.app')

@section('konten')
    <form action="{{ $pelamar ? route('pelamar.update', $pelamar->id) : route('pelamar.update') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($pelamar)
            @method('PUT')
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card mt-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3><i class="fas fa-user"></i> Profil {{ $pelamar->nama_lengkap ?? 'Pelamar Baru' }}</h3>
                        </div>
                        <div class="card-body">
                            <!-- Data Pribadi -->
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        value="{{ old('nik', $pelamar->nik ?? '') }}">
                                    @error('nik')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                        value="{{ old('nama_lengkap', $pelamar->nama_lengkap ?? Auth::user()->name) }}">
                                    @error('nama_lengkap')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                        value="{{ old('tempat_lahir', $pelamar->tempat_lahir ?? '') }}">
                                    @error('tempat_lahir')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir', $pelamar->tanggal_lahir ?? '') }}">
                                    @error('tanggal_lahir')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="male" value="Laki-Laki"
                                                {{ old('jenis_kelamin', $pelamar->jenis_kelamin ?? '') == 'Laki-Laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="female" value="Perempuan"
                                                {{ old('jenis_kelamin', $pelamar->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="tinggi_badan">Tinggi Badan</label>
                                    <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control"
                                        value="{{ old('tinggi_badan', $pelamar->tinggi_badan ?? '') }}">
                                    @error('tinggi_badan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="berat_badan">Berat Badan</label>
                                    <input type="text" id="berat_badan" name="berat_badan" class="form-control"
                                        value="{{ old('berat_badan', $pelamar->berat_badan ?? '') }}">
                                    @error('berat_badan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                        value="{{ old('no_hp', $pelamar->no_hp ?? '') }}">
                                    @error('no_hp')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', $pelamar->email ?? '') }}">
                                    @error('email')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Foto Profil -->
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="profile_picture">Foto Profil</label>
                                    <input type="file" id="profile_picture" name="profile_picture"
                                        class="form-control">
                                    @if ($pelamar && $pelamar->profile_picture)
                                        <img src="{{ asset('images/' . $pelamar->profile_picture) }}"
                                            alt="Profile Picture" class="img-fluid rounded mt-2"
                                            style="max-width: 150px;">
                                    @endif
                                    @error('profile_picture')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Sesuai KTP -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center"><i class="fa-solid fa-location-dot"></i> Alamat Sesuai KTP</h3>
                        </div>
                        <div class="card-body">
                            <!-- Field Alamat KTP -->
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="negara">Negara</label>
                                    <input type="text" id="negara" name="negara" class="form-control"
                                        value="{{ old('negara', $pelamar->negara ?? '') }}">
                                    @error('negara')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control"
                                        value="{{ old('provinsi', $pelamar->provinsi ?? '') }}">
                                    @error('provinsi')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="kota">Kota/Kabupaten</label>
                                    <input type="text" id="kota" name="kota" class="form-control"
                                        value="{{ old('kota', $pelamar->kota ?? '') }}">
                                    @error('kota')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                        value="{{ old('kecamatan', $pelamar->kecamatan ?? '') }}">
                                    @error('kecamatan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                                        value="{{ old('kelurahan', $pelamar->kelurahan ?? '') }}">
                                    @error('kelurahan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="alamat_ktp">Alamat KTP</label>
                                    <input type="text" id="alamat_ktp" name="alamat_ktp" class="form-control"
                                        value="{{ old('alamat_ktp', $pelamar->alamat_ktp ?? '') }}">
                                    @error('alamat_ktp')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="rt">RT</label>
                                    <input type="text" id="rt" name="rt" class="form-control"
                                        value="{{ old('rt', $pelamar->rt ?? '') }}">
                                    @error('rt')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="rw">RW</label>
                                    <input type="text" id="rw" name="rw" class="form-control"
                                        value="{{ old('rw', $pelamar->rw ?? '') }}">
                                    @error('rw')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                        value="{{ old('kode_pos', $pelamar->kode_pos ?? '') }}">
                                    @error('kode_pos')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pendidikan -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center"><i class="fa-solid fa-graduation-cap"></i> Riwayat Pendidikan</h3>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Jenjang Pendidikan</th>
                                <td>
                                    <input type="text" id="jenjang_pendidikan" name="jenjang_pendidikan"
                                        class="form-control"
                                        value="{{ old('jenjang_pendidikan', $pelamar->jenjang_pendidikan ?? '') }}">
                                    @error('jenjang_pendidikan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Institusi</th>
                                <td>
                                    <input type="text" id="nama_institusi" name="nama_institusi" class="form-control"
                                        value="{{ old('nama_institusi', $pelamar->nama_institusi ?? '') }}">
                                    @error('nama_institusi')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>
                                    <input type="text" id="jurusan" name="jurusan" class="form-control"
                                        value="{{ old('jurusan', $pelamar->jurusan ?? '') }}">
                                    @error('jurusan')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Masuk</th>
                                <td>
                                    <input type="text" id="tahun_masuk" name="tahun_masuk" class="form-control"
                                        value="{{ old('tahun_masuk', $pelamar->tahun_masuk ?? '') }}">
                                    @error('tahun_masuk')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Lulus</th>
                                <td>
                                    <input type="text" id="tahun_lulus" name="tahun_lulus" class="form-control"
                                        value="{{ old('tahun_lulus', $pelamar->tahun_lulus ?? '') }}">
                                    @error('tahun_lulus')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>IPK</th>
                                <td>
                                    <input type="text" id="ipk" name="ipk" class="form-control"
                                        value="{{ old('ipk', $pelamar->ipk ?? '') }}">
                                    @error('ipk')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="text-center"><i class="fa-solid fa-list"></i> Berkas Pendaftaran</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Curriculum Vitae/Daftar Riwayat Hidup</th>
                                    <td>
                                        <!-- Form untuk upload file PDF -->
                                        <input type="file" id="cv" name="cv" class="form-control">

                                        <!-- Tautan untuk melihat CV jika ada -->
                                        @if ($pelamar && $pelamar->cv)
                                            <a href="{{ route('cv.show', ['id' => $pelamar->id]) }}" target="_blank"
                                                class="btn btn-primary mt-2">
                                                Lihat CV
                                            </a>
                                        @endif

                                        <!-- Pesan error untuk validasi -->
                                        @error('cv')
                                            <div class="text-danger">*{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="row justify-content-center mt-5">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ $pelamar ? 'Update Data' : 'Simpan Data' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
    <section>

    </section>
@endsection
