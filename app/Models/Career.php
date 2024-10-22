<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_name',
        'maximum_age',
        'minimum_education',
        'major',
        'salary',
        'open_date',
        'close_date',
        'job_desc',
        'job_criteria',
    ];

      // Relasi Career ke Pendaftar (Career memiliki banyak Pendaftar)
      public function pendaftar()
      {
          return $this->hasMany(Pendaftar::class, 'job_id');
      }
}
