<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct(private CourseApi $api)
    {
    }

    public function index(): View
    {
        try {
            $courses = $this->api->index();
        } catch (ApiException $e) {
            $courses = [];
            session()->flash('error', "API error: {$e->getMessage()}");
        }

        return view('courses.index', compact('courses'));
    }

    public function show(string $id): View
    {
        try {
            $course = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }

        return view('courses.show', compact('course'));
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|in:Matí,Diurn',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Course created.');
    }

    public function edit(string $id): View
    {
        try {
            $course = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|in:Matí,Diurn',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "API error: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Course updated.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "API error: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }
}