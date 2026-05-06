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

    <x-page-header title="{{ $department['name'] }}">
        <x-slot:actions>
            <x-button variant="secondary" :href="route('departments.edit', $department['id'])">Editar</x-button>
            <x-confirm-delete :action="route('departments.destroy', $department['id'])" title="¿Eliminar departamento?"
                message="Esta acción no se puede deshacer." />
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card>
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Información
                </h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <dt class="text-xs text-ink-500 mb-1">Nombre</dt>
                        <dd class="font-medium">{{ $department['name'] }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs text-ink-500 mb-1">Identificador</dt>
                        <dd class="font-mono text-xs text-ink-600 dark:text-ink-400 break-all">{{ $department['id'] }}</dd>
                    </div>
                </dl>
            </x-card>
        </div>

        <div>
            <x-card>
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Acciones</h2>
                <div class="space-y-2">
                    <a href="{{ route('teachers.create') }}"
                        class="flex items-center gap-2.5 p-3 rounded-lg border border-ink-200 dark:border-ink-800 hover:border-ink-300 dark:hover:border-ink-700 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-all text-sm">
                        <span class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                        Añadir profesor
                    </a>
                </div>
            </x-card>
        </div>
    </div>

@endsection