@extends('layout.app')

@section('konten')
<div class="container">
    <ul data-aos="fade-up" data-aos-delay="100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('careeruser.index') }}" class="btn btn-secondary" style="margin-top: 10px">Kembali</a>
            </div>
            <div class="card-body">
                <div>
                    <h5 style="font-size: 30px; font-weight: 450;">
                        {{ $job->job_name }}
                    </h5>
                    <h5>Deskripsi Pekerjaan:</h5>
                    <p>{{ $job->job_desc }}</p>

                    <h5>Persyaratan:</h5>
                    <ul>
                        <li>Kriteria: <br>{{ $job->job_criteria }}</li>
                        <li>Maksimal Umur: {{ $job->maximum_age }} th</li>
                        <li>Pendidikan: {{ $job->minimum_education }}</li>
                        <li>Jurusan: {{ $job->major }}</li>
                    </ul><br>
                    <h6>Gaji: {{ $job->salary }}</h6>

                    <h5>Tanggal Pembukaan:</h5>
                    <p>{{ \Carbon\Carbon::parse($job->open_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($job->close_date)->format('d-m-Y') }}</p>

                    <!-- Status Pekerjaan -->
                    @if (now()->between($job->open_date, $job->close_date))
                        <span class="badge bg-success">Open</span>
                    @else
                        <span class="badge bg-secondary">Closed</span>
                    @endif
                </div>
            </div>
        </div>
    </ul>
</div>
@endsection
