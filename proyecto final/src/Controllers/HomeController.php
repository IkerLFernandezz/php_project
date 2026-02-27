<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Student\Student;
use App\Domain\Department\Department;
use App\Domain\Course\Course;
use App\Domain\Teacher\Teacher;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;

final class HomeController
{
    private $em;

    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $this->em = $doctrineBootstrap();
    }

    public function index(): void
    {
        $totalStudents = $this->em->getRepository(Student::class)->count([]);
        $totalTeachers = $this->em->getRepository(Teacher::class)->count([]);
        $totalDepartments = $this->em->getRepository(Department::class)->count([]);
        $totalCourses = $this->em->getRepository(Course::class)->count([]);

        ViewHelper::render('index', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalDepartments' => $totalDepartments,
            'totalCourses' => $totalCourses,
        ]);
    }
}