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
        $apiUp = true;
        $stats = ['courses' => 0, 'departments' => 0, 'teachers' => 0, 'students' => 0, 'subjects' => 0];
        $recentStudents = [];
        $recentSubjects = [];

        try {
            $stats['courses'] = count($this->courses->index());
            $stats['departments'] = count($this->departments->index());
            $stats['teachers'] = count($this->teachers->index());
            $allStudents = $this->students->index();
            $stats['students'] = count($allStudents);
            $allSubjects = $this->subjects->index();
            $stats['subjects'] = count($allSubjects);

            $recentStudents = array_slice(array_reverse($allStudents), 0, 5);
            $recentSubjects = array_slice(array_reverse($allSubjects), 0, 5);
        } catch (ApiException $e) {
            $apiUp = false;
            session()->flash('error', "API unreachable: {$e->getMessage()}");
        }

        return view('dashboard', compact('stats', 'apiUp', 'recentStudents', 'recentSubjects'));
    }
}