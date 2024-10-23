<?php

namespace App\Models;

use App\Models\User;
use App\Models\Career;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use Notifiable; // Tambahkan ini
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

