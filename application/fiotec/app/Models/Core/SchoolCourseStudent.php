<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCourseStudent extends Model
{
    use HasFactory;

    protected $table = 'school_course_student';

    protected $fillable = [
        'school_course_id',
        'student_id',
    ];
}
