<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCourseSubject extends Model
{
    use HasFactory;

    protected $table = 'school_course_subject';

    protected $fillable = [
        'school_course_id',
        'subject_id',
    ];
}
