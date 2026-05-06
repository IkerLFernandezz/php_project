<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use App\Services\Api\Resources\StudentApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private StudentApi $api,
        private CourseApi $courseApi,
    ) {
    }

    public function index(): View
    {
        try {
            $students = $this->api->index();
        } catch (ApiException $e) {
            $students = [];
            session()->flash('error', "API error: {$e->getMessage()}");
        }
        return view('students.index', compact('students'));
    }

    public function show(string $id): View
    {
        try {
            $student = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        return view('students.show', compact('student'));
    }

    public function create(): View
    {
        $courses = $this->safeIndex($this->courseApi);
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50',
            'mail' => 'required|email|max:255',
            'courseId' => 'required|string',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('students.index')->with('success', 'Student created.');
    }

    public function edit(string $id): View
    {
        try {
            $student = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        $courses = $this->safeIndex($this->courseApi);
        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50',
            'mail' => 'required|email|max:255',
            'courseId' => 'required|string',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('students.index')->with('success', 'Student updated.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }

    private function safeIndex($apiResource): array
    {
        try {
            return $apiResource->index();
        } catch (ApiException) {
            return [];
        }
    }
}