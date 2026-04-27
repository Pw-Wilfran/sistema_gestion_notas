<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AcademicAssignmentController;
use App\Http\Controllers\ReportObservationController;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('student', StudentController::class);

Route::post('/grades', [GradeController::class, 'store']);
Route::post('/grades/bulk', [GradeController::class, 'storeBulk']);
Route::get('/grades/{enrollment}/{period}', [GradeController::class, 'byStudentPeriod']);

Route::post('/enrollments', [EnrollmentController::class, 'store']);
Route::post('/enrollments/{id}/cancel', [EnrollmentController::class, 'cancel']);
Route::get('/enrollments/{grade}/{year}', [EnrollmentController::class, 'list']);

Route::get('/report/{enrollment}/{period}', [ReportObservationController::class, 'show']);
Route::post('/report/observations', [ReportObservationController::class, 'saveObservation']);

Route::post('/attendance', [AttendanceController::class, 'storeBulk']);
Route::get('/attendance/{enrollment}/{assignment}', [AttendanceController::class, 'summary']);

Route::post('/assignments', [AcademicAssignmentController::class, 'store']);
Route::get('/assignments/{teacher}/{year}', [AcademicAssignmentController::class, 'byTeacher']);