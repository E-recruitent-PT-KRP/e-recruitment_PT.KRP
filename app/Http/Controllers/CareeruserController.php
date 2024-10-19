<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Pelamar;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class CareeruserController extends Controller
{

    public function applyJob()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil semua data pendaftar berdasarkan user yang sedang login
        $pendaftar = \App\Models\Pendaftar::where('user_id', $user->id)->get();

        // Jika pelamar belum ada, tampilkan pesan atau arahkan ke halaman lain
        if ($pendaftar->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada lamaran yang diajukan.');
        }

        // Ambil pekerjaan terkait jika ada (bisa disesuaikan)
        $job = \App\Models\Job::first(); // Atau sesuaikan pengambilan job

        // Kirim data ke view
        return view('user.career.apply', compact('pendaftar', 'job'));
    }
    public function index()
    {

        $jobs = Job::all()->map(function ($job) {
            $job->open_date = Carbon::parse($job->open_date)->format('d F Y');
            $job->close_date = Carbon::parse($job->close_date)->format('d F Y');
            return $job;
        });

        $user = auth()->user(); // Mendapatkan user yang sedang login

        // Mengambil semua data pendaftar berdasarkan user_id yang sedang login
        $pendaftar = Pendaftar::where('user_id', $user->id)->get();

        return view('user.career.index', compact('jobs', 'user', 'pendaftar'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil detail pekerjaan berdasarkan ID
        $job = Job::findOrFail($id);

        // Ambil data pelamar berdasarkan user yang sedang login
        $pelamar = Pelamar::where('user_id', auth()->user()->id)->first();

        // Pastikan pelamar ada
        if (!$pelamar) {
            return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
        }

        // Return ke view create dengan data pekerjaan dan pelamar
        return view('user.career.create', compact('job', 'pelamar'));
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
        $job = Job::findOrFail($id);

        // Ambil data pelamar berdasarkan user yang sedang login
        $pelamar = Pelamar::where('user_id', auth()->user()->id)->first();

        // Pastikan pelamar ada
        if (!$pelamar) {
            return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
        }

        $pendaftar = new Pendaftar();
        $pendaftar->name = auth()->user()->name;
        $pendaftar->email = auth()->user()->email;
        $pendaftar->job_id = $job->id;
        $pendaftar->user_id = auth()->user()->id; // Set user_id dari user yang sedang login
        $pendaftar->application_date = now();
        $pendaftar->status = 'pending'; // Status default
        $pendaftar->save();


        return redirect()->route('careeruser.index')->with('success', 'Pendaftaran berhasil!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::findOrFail($id); // Mengambil pekerjaan berdasarkan ID
        $job->open_date = Carbon::parse($job->open_date)->format('d F Y');
        $job->close_date = Carbon::parse($job->close_date)->format('d F Y');
        return view('user.career.show', compact('job')); // Kirim data job ke view
    }

    // public function applyForm($id)
    // {
    //     $job = Job::findOrFail($id);
    //     $user = auth()->user();

    //     // Cek apakah user sudah melamar pekerjaan ini
    //     $pendaftar = Pendaftar::where('user_id', $user->id)->where('job_id', $id)->first();


    //     // Kirim data lamaran ke view jika sudah melamar, jika belum, kirim null
    //     return view('user.career.apply', compact('job', 'pendaftar'));
    // }



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
