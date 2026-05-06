<?php
declare(strict_types=1);

use App\Api\Controllers\StudentApiController;
use App\Api\Controllers\TeacherApiController;
use App\Api\Controllers\SubjectApiController;
use App\Api\Controllers\DepartmentApiController;
use App\Api\Controllers\CourseApiController;

return [
    ['method' => 'GET', 'path' => '/api/students', 'handler' => [StudentApiController::class, 'index']],
    ['method' => 'GET', 'path' => '/api/students/{id}', 'handler' => [StudentApiController::class, 'show']],
    ['method' => 'POST', 'path' => '/api/students', 'handler' => [StudentApiController::class, 'store']],
    ['method' => 'PUT', 'path' => '/api/students/{id}', 'handler' => [StudentApiController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/students/{id}', 'handler' => [StudentApiController::class, 'delete']],
    ['method' => 'GET', 'path' => '/api/teachers', 'handler' => [TeacherApiController::class, 'index']],
    ['method' => 'GET', 'path' => '/api/teachers/{id}', 'handler' => [TeacherApiController::class, 'show']],
    ['method' => 'POST', 'path' => '/api/teachers', 'handler' => [TeacherApiController::class, 'store']],
    ['method' => 'PUT', 'path' => '/api/teachers/{id}', 'handler' => [TeacherApiController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/teachers/{id}', 'handler' => [TeacherApiController::class, 'delete']],
    ['method' => 'GET', 'path' => '/api/subjects', 'handler' => [SubjectApiController::class, 'index']],
    ['method' => 'GET', 'path' => '/api/subjects/{id}', 'handler' => [SubjectApiController::class, 'show']],
    ['method' => 'POST', 'path' => '/api/subjects', 'handler' => [SubjectApiController::class, 'store']],
    ['method' => 'PUT', 'path' => '/api/subjects/{id}', 'handler' => [SubjectApiController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/subjects/{id}', 'handler' => [SubjectApiController::class, 'delete']],
    ['method' => 'POST', 'path' => '/api/subjects/{id}/assign-teacher', 'handler' => [SubjectApiController::class, 'assignTeacher']],
    ['method' => 'GET', 'path' => '/api/departments', 'handler' => [DepartmentApiController::class, 'index']],
    ['method' => 'GET', 'path' => '/api/departments/{id}', 'handler' => [DepartmentApiController::class, 'show']],
    ['method' => 'POST', 'path' => '/api/departments', 'handler' => [DepartmentApiController::class, 'store']],
    ['method' => 'PUT', 'path' => '/api/departments/{id}', 'handler' => [DepartmentApiController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/departments/{id}', 'handler' => [DepartmentApiController::class, 'delete']],
    ['method' => 'GET', 'path' => '/api/courses', 'handler' => [CourseApiController::class, 'index']],
    ['method' => 'GET', 'path' => '/api/courses/{id}', 'handler' => [CourseApiController::class, 'show']],
    ['method' => 'POST', 'path' => '/api/courses', 'handler' => [CourseApiController::class, 'store']],
    ['method' => 'PUT', 'path' => '/api/courses/{id}', 'handler' => [CourseApiController::class, 'update']],
    ['method' => 'DELETE', 'path' => '/api/courses/{id}', 'handler' => [CourseApiController::class, 'delete']],
];
