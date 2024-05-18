<?php

namespace App\Http\Controllers\Core;

use App\Models\Core\SchoolCourse;
use App\Models\Core\SchoolCourseStudent;
use App\Models\Core\SchoolCourseSubject;
use App\Http\Controllers\Controller;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;

class SchoolCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SchoolCourse::all();
        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        SchoolCourse::create($data);
        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $builder = SchoolCourse::query();
        // $this->addRelations($builder, ['student']);

        // return new JsonResource($builder->findOrFail($id));
        $schoolCourse = SchoolCourse::FindOrFail($id);
        $schoolCourse->load('students', 'subjects');
        return response()->json(['data' => $schoolCourse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $schoolCourse = SchoolCourse::findOrFail($id);
        $schoolCourse->update($data);

        return response()->json(['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schoolCourse = SchoolCourse::find($id);
        $schoolCourse->delete();
    }

    public function enrollment(Request $request)
    {
        $schoolCourse = SchoolCourseStudent::where('school_course_id', $request->school_course_id)->where('student_id', $request->student_id)->get();
        if ($schoolCourse->isEmpty()) {
            $data = $request->all();
            SchoolCourseStudent::create($data);
            return response()->json(['data' => $data]);
        }
        return response()->json([
            'error' => 'already_exist',
            'message' => 'Aluno já matriculado',
        ], 400);
    }
    public function unenrollment(string $id)
    {
        $schoolCourse = SchoolCourseStudent::find($id);
        $schoolCourse->delete();
    }

    public function subject(Request $request)
    {
        $schoolCourse = SchoolCourseSubject::where('school_course_id', $request->school_course_id)->where('subject_id', $request->subject_id)->get();
        if ($schoolCourse->isEmpty()) {
            $data = $request->all();
            SchoolCourseSubject::create($data);
            return response()->json(['data' => $data]);
        }
        return response()->json([
            'error' => 'already_exist',
            'message' => 'materia já pertence a turma',
        ], 400);
    }
    public function deleteSubject(string $id)
    {
        $schoolCourse = SchoolCourseSubject::find($id);
        $schoolCourse->delete();
    }

}
