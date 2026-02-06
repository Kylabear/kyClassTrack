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
        'is_fixed_student',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'string',
        'is_fixed_student' => 'boolean',
    ];

    // Helper: check if student is fixed
    public static function isFixedStudent($userId, $studentName)
    {
        return self::where('user_id', $userId)
            ->where('student_name', $studentName)
            ->count() >= 5;
    }
}

