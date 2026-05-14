<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesApiResources;
use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use App\Services\Api\Resources\StudentApi;
use App\Services\Api\Resources\SubjectApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    use HandlesApiResources;

    public function __construct(
        private CourseApi $api,
        private StudentApi $studentApi,
        private SubjectApi $subjectApi,
    ) {
    }

    public function index(): View
    {
        try {
            $courses = $this->api->index();
        } catch (ApiException $e) {
            $courses = [];
            session()->flash('error', "Error al cargar los cursos: {$e->getMessage()}");
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

        $students = $this->filterByRelation($this->studentApi, 'course', $id, 'estudiantes');
        $subjects = $this->filterByRelation($this->subjectApi, 'course', $id, 'asignaturas');

        return view('courses.show', compact('course', 'students', 'subjects'));
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
            return back()->withInput()->with('error', "Error al crear el curso: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Curso creado correctamente.');
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
            return back()->withInput()->with('error', "Error al actualizar el curso: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "Error al eliminar el curso: {$e->getMessage()}");
        }

        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
    }
}