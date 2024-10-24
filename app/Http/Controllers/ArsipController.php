<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar; // Pastikan model ini diimpor
use App\Models\Career; // Pastikan model ini diimpor
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function showAccepted() {
        // Mengambil data pelamar yang diterima (status = 'diterima') beserta data pekerjaan
        $acceptedApplicants = Pendaftar::with('job')->where('status', 'diterima')->get();

        // Kirim data ke view
        return view('admin.arsip.accepted', compact('acceptedApplicants'));
    }

    public function showRejected() {
        // Mengambil data pelamar yang ditolak (status = 'ditolak')
        $rejectedApplicants = Pendaftar::with('job')->where('status', 'ditolak')->get();
    
        // Kirim data ke view
        return view('admin.arsip.rejected', compact('rejectedApplicants'));
    }
    
}

