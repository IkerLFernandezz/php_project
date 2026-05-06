<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('courses', CourseController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);