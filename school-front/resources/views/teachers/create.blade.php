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

    <x-page-header title="Nuevo profesor" />

    <form method="POST" action="{{ route('teachers.store') }}" class="max-w-2xl">
        @csrf
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name')" required />
                <x-input name="surname" label="Apellido" :value="old('surname')" required />
                <x-input name="dni" label="DNI" :value="old('dni')" required help="Formato: 12345678X (DNI) o X1234567A (NIE)" />
                <x-input name="mail" label="Correo" type="email" :value="old('mail')" required />

                <x-select name="departmentId" label="Departamento" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($departments as $dep)
                        <option value="{{ $dep['id'] }}"
                            {{ old('departmentId', request('departmentId')) === $dep['id'] ? 'selected' : '' }}>
                            {{ $dep['name'] }}
                        </option>
                    @endforeach
                </x-select>

                @if (empty($departments) && !session('error'))
                    <p class="text-sm text-amber-600 dark:text-amber-400">
                        No hay departamentos creados.
                        <a href="{{ route('departments.create') }}" class="underline hover:no-underline">Crea uno primero</a>.
                    </p>
                @endif
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('teachers.index')">Cancelar</x-button>
            <x-button type="submit">Crear profesor</x-button>
        </div>
    </form>

@endsection