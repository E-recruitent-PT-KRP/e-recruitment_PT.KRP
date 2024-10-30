<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pelamar;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use App\Notifications\ApplyNotification;
use App\Models\Career; // Ubah Job menjadi Career

class CareeruserController extends Controller
{
    public function applyJob()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil semua data pendaftar berdasarkan user yang sedang login
        $pendaftar = Pendaftar::where('user_id', $user->id)->get();

        // Jika pelamar belum ada, tampilkan pesan atau arahkan ke halaman lain
        if ($pendaftar->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada lamaran yang diajukan.');
        }

        // Ambil pekerjaan terkait jika ada (bisa disesuaikan)
        $career = Career::first(); // Mengambil data pertama dari tabel Career

        // Kirim data ke view
        return view('user.career.apply', compact('pendaftar', 'career'));
    }

    public function index()
    {
        $careers = Career::all()->map(function ($career) {
            $career->open_date = Carbon::parse($career->open_date)->format('d F Y');
            $career->close_date = Carbon::parse($career->close_date)->format('d F Y');
            return $career;
        });

        $user = auth()->user(); // Mendapatkan user yang sedang login

        // Mengambil semua data pendaftar berdasarkan user_id yang sedang login
        $pendaftar = Pendaftar::where('user_id', $user->id)->get();

        return view('user.career.index', compact('careers', 'user', 'pendaftar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil detail pekerjaan berdasarkan ID
        $career = Career::findOrFail($id);

        // Ambil data pelamar berdasarkan user yang sedang login
        $pelamar = Pelamar::where('user_id', auth()->user()->id)->first();

        // Pastikan pelamar ada
        if (!$pelamar) {
            return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
        }

        // Return ke view create dengan data pekerjaan dan pelamar
        return view('user.career.create', compact('career', 'pelamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // Validasi request jika diperlukan
        $validated = $request->validate([
            // tambahkan validasi sesuai kebutuhan
        ]);

        // Ambil detail pekerjaan berdasarkan ID
        $career = Career::findOrFail($id);

        // Ambil data pelamar berdasarkan user yang sedang login
        $pelamar = Pelamar::where('user_id', auth()->user()->id)->first();

        // Pastikan pelamar ada
        if (!$pelamar) {
            return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
        }

        $pendaftar = new Pendaftar();
        $pendaftar->name = auth()->user()->name;
        $pendaftar->email = auth()->user()->email;
        $pendaftar->job_id = $career->id; // Pastikan ini sesuai dengan tabel Pendaftar
        $pendaftar->user_id = auth()->user()->id; // Set user_id dari user yang sedang login
        $pendaftar->application_date = now();
        $pendaftar->status = 'pending'; // Status default
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new ApplyNotification($pendaftar));

        return redirect()->route('careeruser.index')->with('success', 'Pendaftaran berhasil!');
    }

    public function show($id)
    {
        $job = Career::findOrFail($id); // Mengambil detail pekerjaan berdasarkan ID
        return view('user.career.show', compact('job')); // Mengarahkan ke view detail pekerjaan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
