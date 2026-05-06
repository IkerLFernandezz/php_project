@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('teachers.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a profesores
        </a>
    </div>

    <x-page-header title="Editar profesor" />

    <form method="POST" action="{{ route('teachers.update', $teacher['id']) }}" class="max-w-2xl">
        @csrf
        @method('PUT')
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name', $teacher['name'])" required />
                <x-input name="surname" label="Apellido" :value="old('surname', $teacher['surname'])" required />
                <x-input name="dni" label="DNI" :value="old('dni', $teacher['dni'])" required />
                <x-input name="mail" label="Correo" type="email" :value="old('mail', $teacher['mail'])" required />

                <x-select name="departmentId" label="Departamento" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($departments as $dep)
                        <option value="{{ $dep['id'] }}" {{ old('departmentId', $teacher['department']['id'] ?? '') === $dep['id'] ? 'selected' : '' }}>
                            {{ $dep['name'] }}
                        </option>
                    @endforeach
                </x-select>
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('teachers.index')">Cancelar</x-button>
            <x-button type="submit">Guardar cambios</x-button>
        </div>
    </form>

@endsection