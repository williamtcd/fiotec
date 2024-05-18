<?php

namespace App\Models\Core;

use App\Models\Core\Student;
use App\Models\Core\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class SchoolCourse extends Model
{
    use HasFactory;

    protected $table = 'schoolcourses';
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
    ];

    public function students(): belongsToMany
    {
        return $this->belongsToMany(Student::class)->withPivot('id');
    }

    public function subjects(): belongsToMany
    {
        return $this->belongsToMany(Subject::class)->withPivot('id');
    }
}
