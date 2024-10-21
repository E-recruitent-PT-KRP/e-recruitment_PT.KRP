<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Career; // Tambahkan model Career
use App\Models\Pelamar;

class PendaftarController extends Controller
{
    // public function index($careerId)
    // {
    //     $career = Career::findOrFail($careerId);
    //     // Kode lainnya...
    //     return view('admin.pendaftar.index', compact('career'));
    // }
    public function index()
    {
        // Ambil data pendaftar beserta data pekerjaan
        $pendaftar = Pendaftar::with('job')->get(); // Ambil data pendaftar beserta pekerjaan
        $careers = Career::all(); // Ambil semua data pekerjaan
    
        // Kirim data ke view
        return view('admin.pendaftar.index', compact('pendaftar', 'careers'));
    }
    public function show($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pelamar = Pelamar::findOrFail($id);

        return view('admin.pendaftar.show', compact('pendaftar','pelamar'));
    }

    
    
}
