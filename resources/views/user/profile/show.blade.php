@extends('layout.app')

@section('konten')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3><i class="fas fa-user"></i> Profil {{ $pelamar->nama_lengkap }}</h3>
                        <a class="btn btn-primary" href="{{ route('pelamar.edit', $pelamar->id) }}">Ubah Profil</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control"
                                    value="{{ $pelamar->nik }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                    value="{{ $pelamar->nama_lengkap }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                    value="{{ $pelamar->tempat_lahir }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                    value="{{ $pelamar->tanggal_lahir }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="male"
                                            value="Laki-Laki" {{ $pelamar->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}
                                            disabled readonly>
                                        <label class="form-check-label" for="male">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="female"
                                            value="Perempuan" {{ $pelamar->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}
                                            disabled readonly>
                                        <label class="form-check-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="tinggi_badan">Tinggi Badan</label>
                                <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control"
                                    value="{{ $pelamar->tinggi_badan }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="berat_badan">Berat Badan</label>
                                <input type="text" id="berat_badan" name="berat_badan" class="form-control"
                                    value="{{ $pelamar->berat_badan }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="no_hp">No. HP</label>
                                <input type="text" id="no_hp" name="no_hp" class="form-control"
                                    value="{{ $pelamar->no_hp }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    value="{{ $pelamar->email }}" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label for="profile_picture">Profile Picture</label>
                                <div class="text-center">
                                    <img src="{{ asset('images/' . $pelamar->profile_picture) }}" alt="Profile Picture"
                                        class="img-fluid rounded" style="max-width: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center"><i class="fa-solid fa-location-dot"></i> Alamat Sesuai KTP</h3>
                    </div>
                    <div class="row">
                        <div class="card-body col-md-6">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="negara">Negara</label>
                                    <input type="text" id="negara" name="negara" class="form-control"
                                        value="{{ $pelamar->negara }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control"
                                        value="{{ $pelamar->provinsi }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kota">Kota/Kabupaten</label>
                                    <input type="text" id="kota" name="kota" class="form-control"
                                        value="{{ $pelamar->kota }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                        value="{{ $pelamar->kecamatan }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                                        value="{{ $pelamar->kelurahan }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="card-body col-md-6">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="alamat_ktp">Alamat KTP</label>
                                    <textarea class="form-control" id="alamat_ktp" name="alamat_ktp" style="height: 100px" disabled>{{ $pelamar->alamat_ktp }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="rt">RT</label>
                                    <input type="text" id="rt" name="rt" class="form-control"
                                        value="{{ $pelamar->rt }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="rw">RW</label>
                                    <input type="text" id="rw" name="rw" class="form-control"
                                        value="{{ $pelamar->rw }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                        value="{{ $pelamar->kode_pos }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center"><i class="fa-solid fa-list"></i> Riwayat Pendidikan</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Jenjang Pendidikan</th>
                            <td><input type="text" id="jenjang_pendidikan" name="jenjang_pendidikan"
                                    class="form-control" value="{{ $pelamar->jenjang_pendidikan }}" disabled></td>
                        </tr>
                        <tr>
                            <th>Nama Institusi</th>
                            <td><input type="text" id="nama_institusi" name="nama_institusi" class="form-control"
                                    value="{{ $pelamar->nama_institusi }}" disabled></td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><input type="text" id="jurusan" name="jurusan" class="form-control"
                                    value="{{ $pelamar->jurusan }}" disabled></td>
                        </tr>
                        <tr>
                            <th>Tahun Masuk</th>
                            <td><input type="text" id="tahun_masuk" name="tahun_masuk" class="form-control"
                                    value="{{ $pelamar->tahun_masuk }}" disabled></td>
                        </tr>
                        <tr>
                            <th>Tahun Lulus</th>
                            <td><input type="text" id="tahun_lulus" name="tahun_lulus" class="form-control"
                                    value="{{ $pelamar->tahun_lulus }}" disabled></td>
                        </tr>
                        <tr>
                            <th>IPK</th>
                            <td><input type="text" id="ipk" name="ipk" class="form-control"
                                    value="{{ $pelamar->ipk }}" disabled></td>
                        </tr>
                    </table>
                </div>
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
                                @if ($pelamar->cv)
                                    <a href="{{ route('cv.show', ['id' => $pelamar->id]) }}" target="_blank"
                                        class="btn btn-primary">
                                        Lihat CV
                                    </a>
                                @else
                                    <p>CV tidak tersedia</p>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <section>

    </section>
@endsection
