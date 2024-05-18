<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\SubjectController;
use App\Http\Controllers\Core\StudentController;
use App\Http\Controllers\Core\SchoolCourseController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([

    'middleware' => ['api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group([

    'middleware' => ['jwt.verify'],
    'prefix' => 'v1'

], function ($router) {

    Route::get('students', [StudentController::class, 'index']);
    Route::post('student', [StudentController::class, 'store']);
    Route::put('student/{id}', [StudentController::class, 'update']);
    Route::get('student/{id}', [StudentController::class, 'show']);
    Route::delete('student/{id}', [StudentController::class, 'destroy']);

    Route::get('subjects', [SubjectController::class, 'index']);
    Route::post('subject', [SubjectController::class, 'store']);
    Route::put('subject/{id}', [SubjectController::class, 'update']);
    Route::get('subject/{id}', [SubjectController::class, 'show']);
    Route::delete('subject/{id}', [SubjectController::class, 'destroy']);

    Route::get('schoolcourses', [SchoolCourseController::class, 'index']);
    Route::post('schoolcourse', [SchoolCourseController::class, 'store']);
    Route::put('schoolcourse/{id}', [SchoolCourseController::class, 'update']);
    Route::get('schoolcourse/{id}', [SchoolCourseController::class, 'show']);
    Route::delete('schoolcourse/{id}', [SchoolCourseController::class, 'destroy']);
    
    Route::post('schoolcourse/student', [SchoolCourseController::class, 'enrollment']);
    Route::delete('schoolcourse/student/{id}', [SchoolCourseController::class, 'unenrollment']);

    Route::post('schoolcourse/subject', [SchoolCourseController::class, 'subject']);
    Route::delete('schoolcourse/subject/{id}', [SchoolCourseController::class, 'deleteSubject']);


});
