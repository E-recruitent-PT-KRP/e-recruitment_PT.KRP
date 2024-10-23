<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use App\Notifications\AccNotification;
use App\Notifications\McuNotification;
use App\Notifications\TesNotification;
use App\Notifications\RejectedNotification;
use App\Notifications\InterviewNotification;
use App\Models\Career; // Tambahkan model Career

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
        // Cari data pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        // Cari pelamar yang berkaitan dengan pendaftar tersebut
        $pelamar = Pelamar::where('id', $pendaftar->user_id)->firstOrFail();

        return view('admin.pendaftar.show', compact('pendaftar', 'pelamar'));
    }

    public function showCv($id)
    {
        $pelamar = Pelamar::find($id);

        if ($pelamar && $pelamar->cv) {
            $pathToFile = public_path('images/cv/' . $pelamar->cv);
            return response()->file($pathToFile, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return abort(404, 'File tidak ditemukan.');
    }




    public function tes($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'tes'; // Status 'pending' disesuaikan dengan kondisi 'proses'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new TesNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi Proses.');
    }

    public function interview($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'interview'; // Status 'pending' disesuaikan dengan kondisi 'proses'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new InterviewNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi Proses.');
    }

    public function mcu($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'mcu'; // Status 'pending' disesuaikan dengan kondisi 'proses'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new McuNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi Proses.');
    }


    public function acc($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'acc'; // Status untuk 'ACC'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new AccNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi ACC.');
    }

    public function tolak($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'ditolak'; // Status untuk 'Ditolak'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new RejectedNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi Ditolak.');
    }



}
