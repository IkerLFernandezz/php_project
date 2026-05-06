@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('departments.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a departamentos
        </a>
    </div>

    <x-page-header title="Nuevo departamento" />

    <form method="POST" action="{{ route('departments.store') }}" class="max-w-2xl">
        @csrf
        <x-card>
            <div class="space-y-5">
                <x-input name="name" label="Nombre" :value="old('name')" required />
            </div>
        </x-card>

        <div class="flex items-center justify-end gap-2 mt-6">
            <x-button variant="secondary" :href="route('departments.index')">Cancelar</x-button>
            <x-button type="submit">Crear departamento</x-button>
        </div>
    </form>

@endsection