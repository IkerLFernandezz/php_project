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

    <x-page-header title="Editar asignatura" />

    <form method="POST" action="{{ route('subjects.update', $subject['id']) }}" class="max-w-2xl">
        @csrf
        @method('PUT')
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name', $subject['name'])" required />

                <div>
                    <p class="text-xs font-medium text-ink-700 dark:text-ink-300 mb-1.5">Curso</p>
                    <div
                        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-700">
                        <x-badge variant="info">{{ $subject['course']['name'] ?? '—' }}</x-badge>
                        <span class="text-xs text-ink-400 dark:text-ink-500">No editable</span>
                    </div>
                </div>

                <x-select name="teacherId" label="Profesor" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher['id'] }}" {{ old('teacherId', $subject['teacher']['id'] ?? '') === $teacher['id'] ? 'selected' : '' }}>
                            {{ $teacher['name'] }} {{ $teacher['surname'] }}
                        </option>
                    @endforeach
                </x-select>
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('subjects.index')">Cancelar</x-button>
            <x-button type="submit">Guardar cambios</x-button>
        </div>
    </form>

@endsection