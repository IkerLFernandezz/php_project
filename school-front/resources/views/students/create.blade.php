@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('students.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a estudiantes
        </a>
    </div>

    <x-page-header title="Nuevo estudiante" />

    <form method="POST" action="{{ route('students.store') }}" class="max-w-2xl">
        @csrf
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name')" required />
                <x-input name="surname" label="Apellido" :value="old('surname')" required />
                <x-input name="dni" label="DNI" :value="old('dni')" required help="Formato: 12345678X (DNI) o X1234567A (NIE)" />
                <x-input name="mail" label="Correo" type="email" :value="old('mail')" required />

                <x-select name="courseId" label="Curso" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course['id'] }}"
                            {{ old('courseId', request('courseId')) === $course['id'] ? 'selected' : '' }}>
                            {{ $course['name'] }} ({{ $course['schedule'] === 'Matí' ? 'Mañana' : 'Tarde' }})
                        </option>
                    @endforeach
                </x-select>

                @if (empty($courses) && !session('error'))
                    <p class="text-sm text-amber-600 dark:text-amber-400">
                        No hay cursos creados.
                        <a href="{{ route('courses.create') }}" class="underline hover:no-underline">Crea uno primero</a>.
                    </p>
                @endif
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('students.index')">Cancelar</x-button>
            <x-button type="submit">Crear estudiante</x-button>
        </div>
    </form>

@endsection