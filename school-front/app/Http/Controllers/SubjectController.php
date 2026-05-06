<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use App\Services\Api\Resources\SubjectApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function __construct(
        private SubjectApi $api,
        private CourseApi $courseApi,
        private TeacherApi $teacherApi,
    ) {
    }

    public function index(): View
    {
        try {
            $subjects = $this->api->index();
        } catch (ApiException $e) {
            $subjects = [];
            session()->flash('error', "API error: {$e->getMessage()}");
        }
        return view('subjects.index', compact('subjects'));
    }

    public function show(string $id): View
    {
        try {
            $subject = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        return view('subjects.show', compact('subject'));
    }

    public function create(): View
    {
        return view('subjects.create', [
            'courses' => $this->safeIndex($this->courseApi),
            'teachers' => $this->safeIndex($this->teacherApi),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'courseId' => 'required|string',
            'teacherId' => 'required|string',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Subject created.');
    }

    public function edit(string $id): View
    {
        try {
            $subject = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        return view('subjects.edit', [
            'subject' => $subject,
            'teachers' => $this->safeIndex($this->teacherApi),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'teacherId' => 'required|string',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Subject deleted.');
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