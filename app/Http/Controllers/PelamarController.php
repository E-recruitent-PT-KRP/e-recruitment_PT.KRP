<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        // $pelamar = Pelamar::where('id', $user->id)->first();

        // return view('user.profile.index', compact('pelamar'));

        $user = auth()->user();
        $pelamar = Pelamar::where('user_id', $user->id)->first(); // pastikan kolomnya benar

        if ($pelamar) {
            // Jika data pelamar ditemukan, tampilkan halaman show
            return view('user.profile.show', compact('pelamar'));
        } else {
            // Jika data pelamar tidak ditemukan, tampilkan halaman index
            return view('user.profile.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('user.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi data
        $validateData = $request->validate([
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_ktp' => 'required|string',
            'rt' => 'required|string|max:4',
            'rw' => 'required|string|max:4',
            'kode_pos' => 'required|string|max:10',
            'jenjang_pendidikan' => 'nullable|string|max:255',
            'nama_institusi' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tahun_masuk' => 'nullable|integer',
            'tahun_lulus' => 'nullable|integer',
            'ipk' => 'nullable|numeric',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ], [
            'nik.required' => 'NIK harus diisi.',
            'nik.string' => 'NIK harus berupa string.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa string.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tempat_lahir.string' => 'Tempat lahir harus berupa string.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan.',
            'tinggi_badan.required' => 'Tinggi badan harus diisi.',
            'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
            'berat_badan.required' => 'Berat badan harus diisi.',
            'berat_badan.numeric' => 'Berat badan harus berupa angka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.string' => 'Nomor HP harus berupa string.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 15 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'profile_picture.image' => 'Gambar profil harus berupa gambar.',
            'profile_picture.mimes' => 'Gambar profil harus bertipe jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Gambar profil tidak boleh lebih dari 2MB.',
            'negara.required' => 'Negara harus diisi.',
            'negara.string' => 'Negara harus berupa string.',
            'negara.max' => 'Negara tidak boleh lebih dari 255 karakter.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'provinsi.string' => 'Provinsi harus berupa string.',
            'provinsi.max' => 'Provinsi tidak boleh lebih dari 255 karakter.',
            'kota.required' => 'Kota harus diisi.',
            'kota.string' => 'Kota harus berupa string.',
            'kota.max' => 'Kota tidak boleh lebih dari 255 karakter.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'kecamatan.string' => 'Kecamatan harus berupa string.',
            'kecamatan.max' => 'Kecamatan tidak boleh lebih dari 255 karakter.',
            'kelurahan.required' => 'Kelurahan harus diisi.',
            'kelurahan.string' => 'Kelurahan harus berupa string.',
            'kelurahan.max' => 'Kelurahan tidak boleh lebih dari 255 karakter.',
            'alamat_ktp.required' => 'Alamat KTP harus diisi.',
            'alamat_ktp.string' => 'Alamat KTP harus berupa string.',
            'rt.required' => 'RT harus diisi.',
            'rt.string' => 'RT harus berupa string.',
            'rt.max' => 'RT tidak boleh lebih dari 4 karakter.',
            'rw.required' => 'RW harus diisi.',
            'rw.string' => 'RW harus berupa string.',
            'rw.max' => 'RW tidak boleh lebih dari 4 karakter.',
            'kode_pos.required' => 'Kode Pos harus diisi.',
            'kode_pos.string' => 'Kode Pos harus berupa string.',
            'kode_pos.max' => 'Kode Pos tidak boleh lebih dari 10 karakter.',
            'jenjang_pendidikan.string' => 'Jenjang pendidikan harus berupa string.',
            'nama_institusi.string' => 'Nama institusi harus berupa string.',
            'jurusan.string' => 'Jurusan harus berupa string.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
            'ipk.numeric' => 'IPK harus berupa angka.',
            'cv.pdf' => 'CV harus berupa file pdf',
        ]);


        // Dapatkan nomor surat terakhir dari database
        $lastLamaran = Pelamar::latest()->first();

        // Jika ada data terakhir, ambil nomor suratnya dan tambahkan 1, jika tidak, atur ke 1
        $nextNoLamaran = $lastLamaran ? intval($lastLamaran->noLamaran) + 1 : 1;
        $nextNoLamaranFormatted = str_pad($nextNoLamaran, 3, '0', STR_PAD_LEFT);

        // Menyimpan data pelamar
        $pelamar = new Pelamar();  // Membuat objek baru dari model Pelamar
        $pelamar->user_id = auth()->user()->id;  // Mengambil ID user yang sedang login
        $pelamar->nik = $validateData['nik'];  // Mengisi NIK
        $pelamar->noLamaran = $nextNoLamaranFormatted;
        $pelamar->nama_lengkap = $validateData['nama_lengkap'];  // Mengisi Nama Lengkap
        $pelamar->tempat_lahir = $validateData['tempat_lahir'];  // Mengisi Tempat Lahir
        $pelamar->tanggal_lahir = date('Y-m-d', strtotime($request->input('tanggal_lahir')));  // Mengisi Tanggal Lahir dan mengkonversi formatnya
        $pelamar->jenis_kelamin = $validateData['jenis_kelamin'];  // Mengisi Jenis Kelamin
        $pelamar->tinggi_badan = $validateData['tinggi_badan'];  // Mengisi Tinggi Badan
        $pelamar->berat_badan = $validateData['berat_badan'];  // Mengisi Berat Badan
        $pelamar->no_hp = $validateData['no_hp'];  // Mengisi No. HP
        $pelamar->email = $validateData['email'];  // Mengisi Email

        $pelamar->negara = $validateData['negara'];  // Mengisi Negara
        $pelamar->provinsi = $validateData['provinsi'];  // Mengisi Provinsi
        $pelamar->kota = $validateData['kota'];  // Mengisi Kota/Kabupaten
        $pelamar->kecamatan = $validateData['kecamatan'];  // Mengisi Kecamatan
        $pelamar->kelurahan = $validateData['kelurahan'];  // Mengisi Kelurahan
        $pelamar->alamat_ktp = $validateData['alamat_ktp'];  // Mengisi Alamat KTP
        $pelamar->rt = $validateData['rt'];  // Mengisi RT
        $pelamar->rw = $validateData['rw'];  // Mengisi RW
        $pelamar->kode_pos = $validateData['kode_pos'];  // Mengisi Kode Pos
        $pelamar->jenjang_pendidikan = $validateData['jenjang_pendidikan'];  // Mengisi Jenjang Pendidikan
        $pelamar->nama_institusi = $validateData['nama_institusi'];  // Mengisi Nama Institusi
        $pelamar->jurusan = $validateData['jurusan'];  // Mengisi Jurusan
        $pelamar->tahun_masuk = $validateData['tahun_masuk'];  // Mengisi Tahun Masuk
        $pelamar->tahun_lulus = $validateData['tahun_lulus'];  // Mengisi Tahun Lulus
        $pelamar->ipk = $validateData['ipk'];  // Mengisi IPK
        $pelamar->user_id = auth()->user()->id; // Ambil ID pengguna yang sedang login

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = 'profil-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);  // Simpan file ke folder public/images
            $pelamar->profile_picture = $filename;  // Simpan nama file di database
        }

        // Menyimpan file CV jika ada
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $cvFilename = 'cv-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/cv'), $cvFilename);  // Menyimpan file ke folder storage/app/public/cvs
            $pelamar->cv = $cvFilename;  // Simpan nama file di database
        }

        // Update data di tabel 'users' juga
        $user = Auth::user();
        $user->name = $request->input('nama_lengkap'); // Ubah nama di tabel 'users'
        $user->email = $request->input('email'); // Ubah email di tabel 'users'
        $user->save();


        $pelamar->save();

        return redirect()->route('pelamar.index')->with('success', 'Data pelamar berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        $pelamar = Pelamar::where('user_id', $user->id)->first();
        return view('user.profile.edit', compact('pelamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validateData = $request->validate([
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_ktp' => 'required|string',
            'rt' => 'required|string|max:4',
            'rw' => 'required|string|max:4',
            'kode_pos' => 'required|string|max:10',
            'jenjang_pendidikan' => 'nullable|string|max:255',
            'nama_institusi' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tahun_masuk' => 'nullable|integer',
            'tahun_lulus' => 'nullable|integer',
            'ipk' => 'nullable|numeric',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ], [
            // Pesan error bisa disesuaikan seperti di metode store...
        ]);

        // Cari pelamar berdasarkan ID
        $pelamar = Pelamar::findOrFail($id);

        // Update data pelamar
        $pelamar->fill($validateData);

        // Jika ada file gambar baru
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($pelamar->profile_picture) {
                $oldImagePath = public_path('images/' . $pelamar->profile_picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);  // Hapus gambar lama dari folder public/images
                }
            }

            // Simpan gambar baru
            $file = $request->file('profile_picture');
            $filename = 'profil-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);  // Simpan file di folder public/images
            $pelamar->profile_picture = $filename;  // Update nama file di database
        }


        // Simpan perubahan file CV jika ada
        if ($request->hasFile('cv')) {
            // Hapus file CV lama jika ada
            if ($pelamar->cv) {
                $oldCvPath = public_path('images/cv/' . $pelamar->cv);
                if (file_exists($oldCvPath)) {
                    unlink($oldCvPath);  // Hapus file lama dari folder public/images/cv
                }
            }

            // Simpan file CV baru
            $file = $request->file('cv');
            $cvFilename = 'cv-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/cv'), $cvFilename);  // Simpan file CV ke folder public/images/cv
            $pelamar->cv = $cvFilename;  // Update nama file CV di database
        }



        // Simpan perubahan ke database
        $pelamar->save();

        // Update data di tabel 'users' juga
        $user = Auth::user();
        $user->name = $request->input('nama_lengkap'); // Ubah nama di tabel 'users'
        $user->email = $request->input('email'); // Ubah email di tabel 'users'
        $user->save();

        // Update data di tabel 'pendaftar' juga
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->name = $request->input('nama_lengkap'); // Ubah nama di tabel 'users'
        $pendaftar->email = $request->input('email'); // Ubah email di tabel 'users'
        $pendaftar->save();


        return redirect()->route('pelamar.index')->with('success', 'Data pelamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    


}
