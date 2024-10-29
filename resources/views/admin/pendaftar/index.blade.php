@extends('layoutadmin.main')

@section('content')
<div class="container">
    <h1>Data Pelamar</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-3">
        <label for="selectJob" class="form-label">Select Job:</label>
        <select id="selectJob" class="form-select" onchange="filterByJob()">
            <option value="" selected disabled>-- Select Job --</option>
            @foreach ($careers as $career)
            <option value="{{ $career->id }}">{{ $career->job_name }}</option>
            @endforeach
        </select>
    </div>

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
                    <th>Action</th> <!-- Kolom Aksi -->
                </tr>
            </thead>
            <tbody id="pendaftarTableBody">
                @foreach ($pendaftar as $item)
                <tr data-job-id="{{ $item->job_id }}">
                    <td class="row-number"></td> <!-- Tempat untuk nomor urut -->
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->job->job_name }}</td>
                    <td>{{ $item->application_date }}</td>
                    {{-- <td>
                        <span class="badge rounded-pill bg-{{ $item->status === 'pending'
                                        ? 'warning'
                                        : ($item->status === 'approved'
                                            ? 'success'
                                            : ($item->status === 'rejected'
                                                ? 'danger'
                                                : 'secondary')) }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td> --}}
                    <td>
                        <span class="badge rounded-pill bg-{{ $item->status === 'pending' 
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
    </div>
</div>

{{-- <script>
    function filterByJob() {
        var selectedId = document.getElementById('selectJob').value;
        var rows = document.querySelectorAll('#pendaftarTableBody tr');

        rows.forEach(function(row) {
            if (selectedId === "" || row.getAttribute('data-job-id') == selectedId) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script> --}}
<script>
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
</script>

@endsection