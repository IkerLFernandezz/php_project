<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesApiResources;
use App\Services\Api\ApiException;
use App\Services\Api\Resources\DepartmentApi;
use App\Services\Api\Resources\TeacherApi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    use HandlesApiResources;

    public function __construct(
        private DepartmentApi $api,
        private TeacherApi $teacherApi,
    ) {
    }

    public function index(): View
    {
        try {
            $departments = $this->api->index();
        } catch (ApiException $e) {
            $departments = [];
            session()->flash('error', "Error al cargar los departamentos: {$e->getMessage()}");
        }
        return view('departments.index', compact('departments'));
    }

    public function show(string $id): View
    {
        try {
            $department = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }

        $teachers = $this->filterByRelation($this->teacherApi, 'department', $id, 'profesores');

        return view('departments.show', compact('department', 'teachers'));
    }

    public function create(): View
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->api->create($data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "Error al crear el departamento: {$e->getMessage()}");
        }
        return redirect()->route('departments.index')->with('success', 'Departamento creado correctamente.');
    }

    public function edit(string $id): View
    {
        try {
            $department = $this->api->show($id);
        } catch (ApiException $e) {
            abort($e->statusCode === 404 ? 404 : 500, $e->getMessage());
        }
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->api->update($id, $data);
        } catch (ApiException $e) {
            return back()->withInput()->with('error', "Error al actualizar el departamento: {$e->getMessage()}");
        }
        return redirect()->route('departments.index')->with('success', 'Departamento actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        try {
            $this->api->destroy($id);
        } catch (ApiException $e) {
            return back()->with('error', "Error al eliminar el departamento: {$e->getMessage()}");
        }
        return redirect()->route('departments.index')->with('success', 'Departamento eliminado correctamente.');
    }
}