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
                            {{ $career->job_name }}
                        </h5>
                        <!-- Menampilkan Detail Pekerjaan -->
                        <h5>Deskripsi Pekerjaan:</h5>
                        <p>{{ $career->job_desc }}</p>

                        <h5>Persyaratan:</h5>
                        <ul>
                            <li>Kriteria: <br>{{ $career->job_criteria }}</li>
                            <li>Maksimal Umur: {{ $career->maximum_age }} th</li>
                            <li>Pendidikan: {{ $career->minimum_education }}</li>
                            <li>Jurusan: {{ $career->major }}</li>

                        </ul><br>
                        <p>Sallary: {{ $career->salary }}</p>

                        <h5>Tanggal Pembukaan:</h5>
                        <p>{{ $career->open_date }} s/d {{ $career->close_date }}</p>

                        <!-- Status Pekerjaan -->
                        @if (now()->between($career->open_date, $career->close_date))
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
