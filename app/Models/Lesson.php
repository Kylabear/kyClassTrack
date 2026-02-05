<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'student_name',
        'age',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        // Keep start_time as a plain time string (HH:MM:SS).
        // Casting to datetime causes key mismatches when loading rows back into the daily schedule.
        'start_time' => 'string',
    ];
}

