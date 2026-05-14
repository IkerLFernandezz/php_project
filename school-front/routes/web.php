<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [GoogleAuthController::class, 'showLogin'])->name('login');
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

Route::middleware('auth.google')->group(function () {
    Route::get('/', fn() => redirect()->route('courses.index'));

    Route::resource('courses', CourseController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('departments', DepartmentController::class);
});