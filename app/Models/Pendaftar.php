<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Career;

class Pendaftar extends Model
{
    // Nama tabel sesuai dengan nama tabel di migration
    protected $table = 'pendaftar';
    protected $fillable = ['name', 'email', 'job_id', 'application_date', 'status'];

    // public function job()
    // {
    //     return $this->belongsTo(Job::class, 'job_id');
    // }

    // public function pelamar()
    // {
    //     return $this->belongsTo(Pelamar::class);
    // }
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Job
    public function job()
    {
        return $this->belongsTo(Career::class, 'job_id');
    }



}
