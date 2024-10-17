@extends('layout.app')

@section('konten')
    <div class="container">
        <ul data-aos="fade-up" data-aos-delay="100">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <!-- Tombol Apply -->
                    <a href="{{ route('careeruser.index') }}" class="btn btn-secondary" style="margin-top: 10px">Kembali</a>
                    {{-- <form action="{{ route('careeruser.store', ['id' => $job->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px">Apply</button>
                    </form> --}}
                </div>
                <div class="card-body">
                    <div>
                        <h5 style="font-size: 30px; font-weight: 450; ">
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
                        <p>Sallary: {{ $job->salary }}</p>

                        <h5>Tanggal Pembukaan:</h5>
                        <p>{{ $job->open_date }} s/d {{ $job->close_date }}</p>

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
    <section>

    </section>
@endsection
