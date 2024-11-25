@extends('layoutadmin.main')

@section('content')
    <div class="container">
        <h1>Data Pelamar</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-2 d-flex">
            {{-- <label for="selectJob" class="form-label">Select Job:</label>
            <select id="selectJob" class="form-select" onchange="filterByJob()">
                <option value="" selected disabled>-- Select Job --</option>
                @foreach ($careers as $career)
                    <option value="{{ $career->id }}">{{ $career->job_name }}</option>
                @endforeach
            </select> --}}
            <form action="{{ route('pendaftar.index') }}" method="GET" class="d-flex" id="pendaftarForm">
                <div class="form-group">
                    <select id="selectPendaftar" name="search" class="form-select form-select-sm w-auto"
                        onchange="this.form.submit()">
                        <option value="" selected>All</option>
                        {{-- @foreach ($pendaftar as $item)
                            <option value="{{ $item->job->job_name }}"
                                {{ request('search') == $item->job->job_name ? 'selected' : '' }}>
                                {{ $item->job->job_name }}
                            </option>
                        @endforeach --}}
                        @foreach ($pendaftarList as $item)
                            @if ($item->job)
                                <option value="{{ $item->job->job_name }}"
                                    {{ request('search') == $item->job->job_name ? 'selected' : '' }}>
                                    {{ $item->job->job_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </form>
            <a href="{{ route('pendaftar.export', ['search' => request('search')]) }}"class="btn btn-primary mx-2 btn-sm">
                <i class="fa fa-file-export"></i> Cetak Excel
            </a>
            {{-- <button class="btn btn-primary mx-2 btn-sm"><i class="fa fa-file-export"></i> Cetak Excel</button> --}}
        </div>

        {{-- <div class="mb-2">
            <button onclick="reloadPage()" class="btn btn-secondary btn-sm">All Jobs</button>
            <button class="btn btn-primary mx-2 btn-sm"><i class="fa fa-file-export"></i> Cetak Excel</button>
        </div> --}}

        <div class="table-responsive mb-2">
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
                        <th>Action</th> <!-- Kolom Aksi -->
                    </tr>
                </thead>
                <tbody id="pendaftarTableBody">
                    @php
                        $nomor = 1 + ($pendaftar->currentPage() - 1) * $pendaftar->perPage();
                    @endphp
                    @foreach ($pendaftar as $item)
                        <tr data-job-id="{{ $item->job_id }}">
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->job->job_name }}</td>
                            <td>{{ $item->application_date }}</td>
                            <td>
                                <span
                                    class="badge rounded-pill bg-{{ $item->status === 'pending'
                                        ? 'warning'
                                        : ($item->status === 'tes'
                                            ? 'info'
                                            : ($item->status === 'interview'
                                                ? 'secondary'
                                                : ($item->status === 'mcu'
                                                    ? 'primary'
                                                    : ($item->status === 'diterima'
                                                        ? 'success'
                                                        : 'danger')))) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('pendaftar.show', $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye fa-sm"></i>
                                </a>
                                <a href="{{ route('pendaftar.showCv', $item->id) }}" class="btn btn-info btn-sm">CV
                                    {{-- <i class="fa fa-eye fa-sm"></i> --}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$pendaftar->links()}} --}}
            {{-- {!! $pendaftar->appends(Request::except('page'))->render() !!} --}}
        </div>
    </div>


    {{-- <script>
        function updateRowNumbers() {
            var rows = document.querySelectorAll('#pendaftarTableBody tr');
            var rowIndex = 1; // Memulai penomoran dari 1

            rows.forEach(function(row) {
                row.querySelector('.row-number').textContent = rowIndex++; // Update nomor urut
            });
        }

        function filterByJob() {
            var selectedId = document.getElementById('selectJob').value;
            var rows = document.querySelectorAll('#pendaftarTableBody tr');
            var rowIndex = 1; // Memulai penomoran dari 1

            rows.forEach(function(row) {
                if (selectedId === "" || row.getAttribute('data-job-id') == selectedId) {
                    row.style.display = ""; // Tampilkan baris
                    row.querySelector('.row-number').textContent = rowIndex++; // Update nomor urut
                } else {
                    row.style.display = "none"; // Sembunyikan baris
                }
            });
        }

        // Panggil fungsi untuk update nomor urut saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateRowNumbers();
        });


        function reloadPage() {
            window.location.reload(); // Reload halaman
        }
    </script> --}}
@endsection
