@extends('layoutadmin.main')

@section('content')
<div class="container">
    <h1>Data Pelamar Ditolak</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table text-start align-middle table-striped table-hover" id="dataTable" width="100%"
            cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rejectedApplicants as $index => $applicant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $applicant->name }}</td>
                    <td>{{ $applicant->email }}</td>
                    <td>{{ $applicant->job->job_name }}</td> <!-- Ubah jika ingin menampilkan judul pekerjaan -->
                    <td>{{ $applicant->application_date }}</td>
                    <td>{{ $applicant->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection