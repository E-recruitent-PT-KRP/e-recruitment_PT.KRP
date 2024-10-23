@extends('layout.app')

@section('konten')
    <section id="menu" class="menu section">
        <div class="container section-title" data-aos="fade-up">
            <p><span>Lamaran</span> <span class="description-title">Pekerjaan Saya</span></p>
        </div>

        <div class="container">
            <ul data-aos="fade-up" data-aos-delay="100">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Daftar Lamaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Job</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Status</th>
                                        <th>Tanggal Tes</th>
                                        <th>Tanggal Interview</th>
                                        <th>Tanggal MCU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftar as $lamaran)
                                        <tr>
                                            <td>{{ $lamaran->name }}</td>
                                            {{-- <td>{{ $lamaran->email }}</td> --}}
                                            <td>{{ $lamaran->job->job_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lamaran->application_date)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($lamaran->status) }}</td>
                                            <td>{{ $lamaran->tanggal_tes ? \Carbon\Carbon::parse($lamaran->tanggal_tes)->format('d-m-Y H:i') : 'Belum dijadwalkan' }}</td>
                                            <td>{{ $lamaran->tanggal_interview ? \Carbon\Carbon::parse($lamaran->tanggal_interview)->format('d-m-Y H:i') : 'Belum dijadwalkan' }}</td>
                                            <td>{{ $lamaran->tanggal_mcu ? \Carbon\Carbon::parse($lamaran->tanggal_mcu)->format('d-m-Y H:i') : 'Belum dijadwalkan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </section>
@endsection
