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




    public function tes(Request $request, $id)
    {
        // Validasi input tanggal dan waktu tes
        $request->validate([
            'tanggal_tes' => 'required|date',
            'waktu_tes' => 'required|date_format:H:i',
        ]);

        // Temukan pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        // Ubah status menjadi 'tes'
        $pendaftar->status = 'tes';

        // Simpan tanggal dan waktu tes ke dalam kolom tanggal_tes
        $pendaftar->tanggal_tes = $request->input('tanggal_tes') . ' ' . $request->input('waktu_tes');

        // Simpan perubahan ke database
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new TesNotification($pendaftar));

        // Redirect dengan pesan sukses
        return redirect()->route('pendaftar.show', $pendaftar->id)
            ->with('success', 'Status berhasil diubah menjadi Tes dan tanggal tes telah disimpan.');
    }

    public function interview(Request $request, $id)
    {
        // Validasi input tanggal dan waktu interview
        $request->validate([
            'tanggal_interview' => 'required|date',
            'waktu_interview' => 'required|date_format:H:i',
        ]);

        // Temukan pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        // Ubah status menjadi 'interview'
        $pendaftar->status = 'interview';

        // Simpan tanggal dan waktu interview ke dalam kolom tanggal_interview
        $pendaftar->tanggal_interview = $request->input('tanggal_interview') . ' ' . $request->input('waktu_interview');

        // Simpan perubahan ke database
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new InterviewNotification($pendaftar));

        // Redirect dengan pesan sukses
        return redirect()->route('pendaftar.show', $pendaftar->id)
            ->with('success', 'Status berhasil diubah menjadi Interview dan tanggal interview telah disimpan.');
    }

    public function mcu(Request $request, $id)
    {
        // Validasi input tanggal dan waktu MCU
        $request->validate([
            'tanggal_mcu' => 'required|date',
            'waktu_mcu' => 'required|date_format:H:i',
        ]);

        // Temukan pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        // Ubah status menjadi 'mcu'
        $pendaftar->status = 'mcu';

        // Simpan tanggal dan waktu MCU ke dalam kolom tanggal_mcu
        $pendaftar->tanggal_mcu = $request->input('tanggal_mcu') . ' ' . $request->input('waktu_mcu');

        // Simpan perubahan ke database
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new McuNotification($pendaftar));

        // Redirect dengan pesan sukses
        return redirect()->route('pendaftar.show', $pendaftar->id)
            ->with('success', 'Status berhasil diubah menjadi MCU dan tanggal MCU telah disimpan.');
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
