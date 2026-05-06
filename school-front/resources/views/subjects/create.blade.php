@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('subjects.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a asignaturas
        </a>
    </div>

    <x-page-header title="Nueva asignatura" />

    <form method="POST" action="{{ route('subjects.store') }}" class="max-w-2xl">
        @csrf
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name')" required />

                <x-select name="courseId" label="Curso" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course['id'] }}" {{ old('courseId') === $course['id'] ? 'selected' : '' }}>
                            {{ $course['name'] }} ({{ $course['schedule'] }})
                        </option>
                    @endforeach
                </x-select>

                @if (empty($courses))
                    <p class="text-sm text-amber-600 dark:text-amber-400">
                        No hay cursos creados.
                        <a href="{{ route('courses.create') }}" class="underline hover:no-underline">Crea uno primero</a>.
                    </p>
                @endif

                <x-select name="teacherId" label="Profesor" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher['id'] }}" {{ old('teacherId') === $teacher['id'] ? 'selected' : '' }}>
                            {{ $teacher['name'] }} {{ $teacher['surname'] }}
                        </option>
                    @endforeach
                </x-select>

                @if (empty($teachers))
                    <p class="text-sm text-amber-600 dark:text-amber-400">
                        No hay profesores creados.
                        <a href="{{ route('teachers.create') }}" class="underline hover:no-underline">Crea uno primero</a>.
                    </p>
                @endif
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('subjects.index')">Cancelar</x-button>
            <x-button type="submit">Crear asignatura</x-button>
        </div>
    </form>

@endsection