<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use App\Services\Api\Resources\DepartmentApi;
use App\Services\Api\Resources\StudentApi;
use App\Services\Api\Resources\SubjectApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private CourseApi $courses,
        private DepartmentApi $departments,
        private TeacherApi $teachers,
        private StudentApi $students,
        private SubjectApi $subjects,
    ) {
    }

    public function index(): View
    {
        $stats = ['courses' => 0, 'departments' => 0, 'teachers' => 0, 'students' => 0, 'subjects' => 0];
        $recentStudents = [];
        $recentSubjects = [];

        $loaders = [
            'courses' => [$this->courses, 'cursos'],
            'departments' => [$this->departments, 'departamentos'],
            'teachers' => [$this->teachers, 'profesores'],
            'students' => [$this->students, 'estudiantes'],
            'subjects' => [$this->subjects, 'asignaturas'],
        ];

        $loaded = [];
        $failed = [];

        foreach ($loaders as $key => [$api, $label]) {
            try {
                $items = $api->index();
                $loaded[$key] = $items;
                $stats[$key] = count($items);
            } catch (ApiException) {
                $failed[] = $label;
            }
        }

        if (isset($loaded['students'])) {
            $recentStudents = array_slice(array_reverse($loaded['students']), 0, 5);
        }
        if (isset($loaded['subjects'])) {
            $recentSubjects = array_slice(array_reverse($loaded['subjects']), 0, 5);
        }

        $apiUp = empty($failed);

        if (!$apiUp) {
            session()->flash('error', 'No se pudo cargar: ' . implode(', ', $failed) . '.');
        }

        return view('dashboard', compact('stats', 'apiUp', 'recentStudents', 'recentSubjects'));
    }
}