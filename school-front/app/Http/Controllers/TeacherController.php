<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesApiResources;
use App\Services\Api\ApiException;
use App\Services\Api\Resources\DepartmentApi;
use App\Services\Api\Resources\SubjectApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    use HandlesApiResources;

    public function __construct(
        private TeacherApi $api,
        private DepartmentApi $departmentApi,
        private SubjectApi $subjectApi,
    ) {
    }

    public function index(): View
    {
        try {
            $teachers = $this->api->index();
        } catch (ApiException $e) {
            $teachers = [];
            session()->flash('error', "Error al cargar los profesores: {$e->getMessage()}");
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

        $subjects = $this->filterByRelation($this->subjectApi, 'teacher', $id, 'asignaturas');

        return view('teachers.show', compact('teacher', 'subjects'));
    }

    public function create(): View
    {
        $departments = $this->safeIndex($this->departmentApi, 'departamentos');
        return view('teachers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50|regex:/^[XYZxyz]?\d{7,8}[A-Za-z]$/',
            'mail' => 'required|email|max:255',
            'departmentId' => 'required|string',
        ], [
            'dni.regex' => 'El DNI/NIE no tiene un formato válido (ej. 12345678X).',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "Error al crear el profesor: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Profesor creado correctamente.');
    }

    public function edit(string $id): View
    {
        try {
            $teacher = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        $departments = $this->safeIndex($this->departmentApi, 'departamentos');
        return view('teachers.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|string|max:50|regex:/^[XYZxyz]?\d{7,8}[A-Za-z]$/',
            'mail' => 'required|email|max:255',
            'departmentId' => 'required|string',
        ], [
            'dni.regex' => 'El DNI/NIE no tiene un formato válido (ej. 12345678X).',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "Error al actualizar el profesor: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "Error al eliminar el profesor: {$e->getMessage()}");
        }
        return redirect()->route('teachers.index')->with('success', 'Profesor eliminado correctamente.');
    }
}