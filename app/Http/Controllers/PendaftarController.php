<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use App\Exports\PendaftarExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\McuNotification;
use App\Notifications\TesNotification;
use App\Notifications\AcceptedNotification;
use App\Notifications\RejectedNotification;
use App\Notifications\InterviewNotification;
use App\Models\Career; // Tambahkan model Career

class PendaftarController extends Controller
{
    // public function index()
    // {
    //     // Ambil data pendaftar beserta data pekerjaan
    //     $pendaftar = Pendaftar::with('job')->get(); // Ambil data pendaftar beserta pekerjaan
    //     $careers = Career::all(); // Ambil semua data pekerjaan

    //     // Kirim data ke view
    //     return view('admin.pendaftar.index', compact('pendaftar', 'careers'));
    // }

    // public function index(Request $request)
    // {
    //     $search = $request->query('search');

    //     if (!empty($search)) {
    //         $dataPendaftar = Pendaftar::with('job') // Eager loading relasi job
    //             ->whereHas('job', function ($query) use ($search) { // Memfilter berdasarkan pekerjaan
    //                 $query->where('job_name', 'like', '%' . $search . '%');
    //             })
    //             ->orWhere('pendaftar.name', 'like', '%' . $search . '%') // Filter nama pendaftar
    //             ->paginate(10)
    //             ->onEachSide(2)
    //             ->fragment('dft');
    //     } else {
    //         $dataPendaftar = Pendaftar::paginate(10)
    //             ->onEachSide(2)
    //             ->fragment('prd');
    //     }

    //     $pendaftarList = Pendaftar::all();
    //     return view('admin.pendaftar.index', compact('pendaftarList'))->with([
    //         'pendaftar' => $dataPendaftar,
    //         'search' => $search,
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');

        // Jika ada pencarian berdasarkan job_name
        if (!empty($search)) {
            $dataPendaftar = Pendaftar::with('job')
                ->whereHas('job', function ($query) use ($search) {
                    $query->where('job_name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->onEachSide(2)
                ->fragment('dft');
        } else {
            // Jika tidak ada pencarian, ambil semua data
            $dataPendaftar = Pendaftar::paginate(10)
                ->onEachSide(2)
                ->fragment('prd');
        }

        $pendaftarList = Pendaftar::all(); // Ambil semua data pendaftar untuk select option
        return view('admin.pendaftar.index', compact('pendaftarList'))->with([
            'pendaftar' => $dataPendaftar,
            'search' => $search,
        ]);
    }


    public function show($id)
    {
        // Cari data pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);
        // Mendapatkan pelamar berdasarkan user_id
        $pelamar = Pelamar::where('user_id', $pendaftar->user_id)->firstOrFail();


        // // Cari pelamar yang berkaitan dengan pendaftar tersebut
        // $pelamar = Pelamar::where('id', $pendaftar->user_id)->firstOrFail();

        return view('admin.pendaftar.show', compact('pendaftar', 'pelamar'));
    }

    public function showCv($id)
    {
        // $pelamar = Pelamar::find($id);
        // Mendapatkan pelamar berdasarkan user_id
        $pendaftar = Pendaftar::findOrFail($id);
        $pelamar = Pelamar::where('user_id', $pendaftar->user_id)->firstOrFail();


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


    public function terima($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = 'diterima'; // Status untuk 'terima'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new AcceptedNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi terima.');
    }

    public function tolak(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->keterangan = $request->input('keterangan');
        $pendaftar->status = 'ditolak'; // Status untuk 'Ditolak'
        $pendaftar->save();

        // Kirim notifikasi
        $pendaftar->notify(new RejectedNotification($pendaftar));

        return redirect()->route('pendaftar.show', $pendaftar->id)->with('success', 'Status berhasil diubah menjadi Ditolak.');
    }


    // Fungsi untuk mengekspor data
    // public function export(Request $request)
    // {
    //     return Excel::download(new PendaftarExport($request), 'pendaftar.xlsx');
    // }

    public function export(Request $request)
    {
        $search = $request->query('search');
        return Excel::download(new PendaftarExport($search), 'pendaftar.xlsx');
    }



}
