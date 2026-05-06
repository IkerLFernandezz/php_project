<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiException;
use App\Services\Api\Resources\DepartmentApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(
        private TeacherApi $api,
        private DepartmentApi $departmentApi,
    ) {
    }

    public function index(): View
    {
        try {
            $teachers = $this->api->index();
        } catch (ApiException $e) {
            $teachers = [];
            session()->flash('error', "API error: {$e->getMessage()}");
        }
        return view('teachers.index', compact('teachers'));
    }

    public function show(string $id): View
    {
        try {
            $teacher = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        return view('teachers.show', compact('teacher'));
    }

    public function create(): View
    {
        $departments = $this->safeIndex($this->departmentApi);
        return view('teachers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50',
            'mail' => 'required|email|max:255',
            'departmentId' => 'required|string',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Teacher created.');
    }

    public function edit(string $id): View
    {
        try {
            $teacher = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        $departments = $this->safeIndex($this->departmentApi);
        return view('teachers.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50',
            'mail' => 'required|email|max:255',
            'departmentId' => 'required|string',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Teacher updated.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "API error: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted.');
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