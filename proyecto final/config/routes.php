<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\StudentsController;
use App\Controllers\CoursesController;
use App\Controllers\TeachersController;
use App\Controllers\DepartmentsController;
use App\Controllers\SubjectsController;

return [
    [
        'method' => 'GET',
        'path' => '/',
        'handler' => [HomeController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/students',
        'handler' => [StudentsController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/students/create',
        'handler' => [StudentsController::class, 'createForm']
    ],
    [
        'method' => 'POST',
        'path' => '/students/store',
        'handler' => [StudentsController::class, 'store']
    ],
    [
        'method' => 'GET',
        'path' => '/students/edit/{id}',
        'handler' => [StudentsController::class, 'editForm']
    ],
    [
        'method' => 'POST',
        'path' => '/students/update/{id}',
        'handler' => [StudentsController::class, 'update']
    ],
    [
        'method' => 'POST',
        'path' => '/students/delete/{id}',
        'handler' => [StudentsController::class, 'delete']
    ],
    [
        'method' => 'POST',
        'path' => '/students/enroll/{id}',
        'handler' => [StudentsController::class, 'enroll']
    ],
    [
        'method' => 'GET',
        'path' => '/courses',
        'handler' => [CoursesController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/courses/create',
        'handler' => [CoursesController::class, 'createForm']
    ],
    [
        'method' => 'POST',
        'path' => '/courses/store',
        'handler' => [CoursesController::class, 'store']
    ],
    [
        'method' => 'GET',
        'path' => '/courses/edit/{id}',
        'handler' => [CoursesController::class, 'editForm']
    ],
    [
        'method' => 'POST',
        'path' => '/courses/update/{id}',
        'handler' => [CoursesController::class, 'update']
    ],
    [
        'method' => 'POST',
        'path' => '/courses/delete/{id}',
        'handler' => [CoursesController::class, 'delete']
    ],
    [
        'method' => 'GET',
        'path' => '/subjects/create',
        'handler' => [SubjectsController::class, 'createForm']
    ],
    [
        'method' => 'POST',
        'path' => '/subjects/store',
        'handler' => [SubjectsController::class, 'store']
    ],
    [
        'method' => 'GET',
        'path' => '/subjects/edit/{id}',
        'handler' => [SubjectsController::class, 'editForm']
    ],
    [
        'method' => 'POST',
        'path' => '/subjects/update/{id}',
        'handler' => [SubjectsController::class, 'update']
    ],
    [
        'method' => 'POST',
        'path' => '/subjects/delete/{id}',
        'handler' => [SubjectsController::class, 'delete']
    ],
    [
        'method' => 'POST',
        'path' => '/subjects/assign-teacher/{id}',
        'handler' => [SubjectsController::class, 'assignTeacher']
    ],
    [
        'method' => 'GET',
        'path' => '/teachers',
        'handler' => [TeachersController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/teachers/create',
        'handler' => [TeachersController::class, 'createForm']
    ],
    [
        'method' => 'POST',
        'path' => '/teachers/store',
        'handler' => [TeachersController::class, 'store']
    ],
    [
        'method' => 'GET',
        'path' => '/teachers/edit/{id}',
        'handler' => [TeachersController::class, 'editForm']
    ],
    [
        'method' => 'POST',
        'path' => '/teachers/update/{id}',
        'handler' => [TeachersController::class, 'update']
    ],
    [
        'method' => 'POST',
        'path' => '/teachers/delete/{id}',
        'handler' => [TeachersController::class, 'delete']
    ],
    [
        'method' => 'GET',
        'path' => '/departments',
        'handler' => [DepartmentsController::class, 'index']
    ],
    [
        'method' => 'GET',
        'path' => '/departments/create',
        'handler' => [DepartmentsController::class, 'createForm']
    ],
    [
        'method' => 'POST',
        'path' => '/departments/store',
        'handler' => [DepartmentsController::class, 'store']
    ],
    [
        'method' => 'GET',
        'path' => '/departments/edit/{id}',
        'handler' => [DepartmentsController::class, 'editForm']
    ],
    [
        'method' => 'POST',
        'path' => '/departments/update/{id}',
        'handler' => [DepartmentsController::class, 'update']
    ],
    [
        'method' => 'POST',
        'path' => '/departments/delete/{id}',
        'handler' => [DepartmentsController::class, 'delete']
    ],
];
