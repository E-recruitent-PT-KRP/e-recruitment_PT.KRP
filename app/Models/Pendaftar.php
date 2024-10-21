<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Career;
use App\Models\User;

class Pendaftar extends Model
{
    use HasFactory;

    // Nama tabel sesuai dengan tabel di database
    protected $table = 'pendaftar';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['name', 'email', 'job_id', 'application_date', 'status'];

    // Relasi ke tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel 'careers' menggunakan 'job_id' sebagai foreign key
    public function job()
    {
        return $this->belongsTo(Career::class, 'job_id');
    }
}

