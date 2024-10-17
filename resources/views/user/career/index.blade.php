@extends('layout.app')

@section('konten')
    <!-- Menu Section -->
    <section id="menu" class="menu section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Pekerjaan</h2>
            <p><span>Silahkan</span> <span class="description-title">Daftar Pekerjaan Disini</span></p>
        </div><!-- End Section Title -->
        <!-- Begin Page Content -->
        <div class="container">

            <ul data-aos="fade-up" data-aos-delay="100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- @forelse ($jobs as $job)
                    @if (auth()->check() && isset($job))
                        <a href="{{ route('careeruser.applyForm', ['id' => $job->id]) }}" class="btn btn-primary mb-4">
                            Lamaran Saya
                        </a>
                    @else
                        <a href="#" class="btn btn-secondary mb-4">Kamu Belum Melamar</a>
                    @endif
                @empty
                    <p>Tidak ada pekerjaan tersedia saat ini.</p>
                @endforelse --}}

                <a href="{{ route('careeruser.applyJob') }}" class="btn btn-primary mb-4">
                    Lamaran Saya
                </a>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Daftar Pekerjaan Yang Dibuka</h6>
                    </div>
                    <div class="card-body">
                        <div class="table table-bordered">
                            <table class="table text-start align-middle table-striped table-hover" id="dataTable"
                                width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>
                                                <ul style="list-style-type:none; padding-left: 0;">
                                                    <li style="font-size: 30px; font-weight: 450; color: #6096B4">
                                                        {{ $job->job_name }}
                                                    </li>
                                                    <li style="border-bottom: 1px solid #ccc; padding: 10px 0">
                                                        {{ $job->open_date }} s/d {{ $job->close_date }}
                                                    </li>
                                                    <li>
                                                        @if (now()->between($job->open_date, $job->close_date))
                                                            <span class="badge bg-success">Open</span>
                                                        @else
                                                            <span class="badge bg-secondary">Close</span>
                                                        @endif
                                                    </li>

                                                    <li>Maximum Age: {{ $job->maximum_age }}</li>
                                                    <li>Minimum Education: {{ $job->minimum_education }}</li>
                                                    <li>Major: {{ $job->major }}</li>
                                                    <li style="border-bottom: 1px solid #ccc;">Salary: {{ $job->salary }}
                                                    </li>
                                                    <li>
                                                        @if (auth()->check())
                                                            @php
                                                                // Cek apakah user sudah melamar pekerjaan ini
                                                                $hasApplied = $user->pendaftar->contains(
                                                                    'job_id',
                                                                    $job->id,
                                                                );
                                                            @endphp
                                                            @if (now()->between($job->open_date, $job->close_date))
                                                                @if ($hasApplied)
                                                                    <button class="btn btn-success" style="margin-top: 10px"
                                                                        disabled>Sudah Daftar</button>
                                                                @else
                                                                    <form
                                                                        action="{{ route('careeruser.store', ['id' => $job->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-primary"
                                                                            style="margin-top: 10px">Apply</button>
                                                                    </form>
                                                                @endif
                                                            @else
                                                            <button class="btn btn-secondary" style="margin-top: 10px"
                                                            disabled>Ditutup</button>
                                                            @endif

                                                            <a href="{{ route('careeruser.show', ['careeruser' => $job->id]) }}"
                                                                class="btn btn-secondary"
                                                                style="margin-top: 10px">Detail</a>
                                                        @endif
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No jobs available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </section>
@endsection
