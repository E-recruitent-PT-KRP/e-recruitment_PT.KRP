<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;
    protected $table = 'job';

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
}