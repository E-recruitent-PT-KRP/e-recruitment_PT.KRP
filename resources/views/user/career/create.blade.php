@extends('layout.app')

@section('konten')
    <div class="container">
        <ul data-aos="fade-up" data-aos-delay="100">
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <!-- Form untuk Daftar Pekerjaan -->
                    <form action="{{ route('careeruser.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <!-- Input Hidden untuk Mengirim job_id -->
                        <input type="hidden" name="job_id" value="{{ $job->id }}">

                        <!-- Daftar Pelamar (Opsional untuk ditampilkan) -->
                        <div>
                            <h5 style="font-size: 20px;">Data Pelamar</h5>
                            <p>Nama: {{ $pelamar->nama_lengkap }}</p>
                            <p>Email: {{ $pelamar->email }}</p>
                            <p>No. HP: {{ $pelamar->no_hp }}</p>
                        </div>

                        <!-- Tampilkan Nama dan Deskripsi Pekerjaan -->
                        <h5 style="font-size: 30px; font-weight: 450;">
                            {{ $job->job_name }}
                        </h5>

                        <!-- Menampilkan Detail Pekerjaan -->
                        <h5>Deskripsi Pekerjaan:</h5>
                        <p>{{ $job->job_desc }}</p>

                        <h5>Persyaratan:</h5>
                        <ul>
                            <li>Kriteria: <br>{{ $job->job_criteria }}</li>
                            <li>Maksimal Umur: {{ $job->maximum_age }} th</li>
                            <li>Pendidikan: {{ $job->minimum_education }}</li>
                            <li>Jurusan: {{ $job->major }}</li>
                        </ul><br>
                        <p>Salary: {{ $job->salary }}</p>

                        <h5>Tanggal Pembukaan:</h5>
                        <p>{{ $job->open_date }} s/d {{ $job->close_date }}</p>

                        <!-- Status Pekerjaan -->
                        @if (now()->between($job->open_date, $job->close_date))
                            <span class="badge bg-success">Open</span>
                        @else
                            <span class="badge bg-secondary">Closed</span>
                        @endif

                        <!-- Tombol Daftar -->
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Daftar</button>
                    </form>
                </div>
            </div>
        </ul>
    </div>
@endsection
