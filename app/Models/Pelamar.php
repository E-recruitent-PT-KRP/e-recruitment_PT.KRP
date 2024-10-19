<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;
    protected $table = 'pelamar';
    // protected $fillable = [
    //     'user_id',
    //     'nik', 'nama_lengkap', 
    //     'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
    //     'tinggi_badan', 'berat_badan', 'no_hp', 'email', 'profile_picture',
    //     'negara', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'alamat_ktp',
    //     'rt', 'rw', 'kode_pos', 'jenjang_pendidikan', 'nama_institusi', 'jurusan',
    //     'tahun_masuk', 'tahun_lulus', 'ipk',
    // ];

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'noLamaran';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function pendaftar()
    // {
    //     return $this->hasMany(Pendaftar::class);
    // }
}
