<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesApiResources;
use App\Services\Api\ApiException;
use App\Services\Api\Resources\CourseApi;
use App\Services\Api\Resources\SubjectApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    use HandlesApiResources;

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
            session()->flash('error', "Error al cargar las asignaturas: {$e->getMessage()}");
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
            'courses' => $this->safeIndex($this->courseApi, 'cursos'),
            'teachers' => $this->safeIndex($this->teacherApi, 'profesores'),
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
            return back()->withInput()->with('error', "Error al crear la asignatura: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Asignatura creada correctamente.');
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
            'teachers' => $this->safeIndex($this->teacherApi, 'profesores'),
        ]);
    }

    // Note: courseId is intentionally not editable. Changing a subject's course
    // after creation would break coherence with already-enrolled students.
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'teacherId' => 'required|string',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "Error al actualizar la asignatura: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Asignatura actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "Error al eliminar la asignatura: {$e->getMessage()}");
        }
        return redirect()->route('subjects.index')->with('success', 'Asignatura eliminada correctamente.');
    }
}