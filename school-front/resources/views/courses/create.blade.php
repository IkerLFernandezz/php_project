@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('courses.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a cursos
        </a>
    </div>

    <x-page-header title="Nuevo curso" />

    <form method="POST" action="{{ route('courses.store') }}" class="max-w-2xl">
        @csrf
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name')" required />

                {{-- Option values stay as Matí/Diurn (what the API expects), only labels change. --}}
                <x-select name="schedule" label="Turno" required>
                    <option value="">— Selecciona —</option>
                    <option value="Matí"  {{ old('schedule') === 'Matí'  ? 'selected' : '' }}>Mañana</option>
                    <option value="Diurn" {{ old('schedule') === 'Diurn' ? 'selected' : '' }}>Tarde</option>
                </x-select>
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('courses.index')">Cancelar</x-button>
            <x-button type="submit">Crear curso</x-button>
        </div>
    </form>

@endsection