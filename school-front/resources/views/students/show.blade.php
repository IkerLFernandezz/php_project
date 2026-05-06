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

    <x-page-header title="{{ $student['name'] }} {{ $student['surname'] }}">
        <x-slot:actions>
            <x-button variant="secondary" :href="route('students.edit', $student['id'])">Editar</x-button>
            <x-confirm-delete :action="route('students.destroy', $student['id'])" title="¿Eliminar estudiante?"
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
                        <dd class="font-medium">{{ $student['name'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-ink-500 mb-1">Apellido</dt>
                        <dd class="font-medium">{{ $student['surname'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-ink-500 mb-1">DNI</dt>
                        <dd class="font-mono text-sm">{{ $student['dni'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-ink-500 mb-1">Correo</dt>
                        <dd class="text-sm">{{ $student['mail'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-ink-500 mb-1">Curso</dt>
                        <dd>
                            @if (!empty($student['course']['name']))
                                <x-badge variant="info">{{ $student['course']['name'] }}</x-badge>
                            @else
                                <span class="text-ink-400 dark:text-ink-600 text-sm">Sin asignar</span>
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs text-ink-500 mb-1">Identificador</dt>
                        <dd class="font-mono text-xs text-ink-600 dark:text-ink-400 break-all">{{ $student['id'] }}</dd>
                    </div>
                </dl>
            </x-card>
        </div>

        <div>
            <x-card>
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Acciones</h2>
                <div class="space-y-2">
                    @if (!empty($student['course']['id']))
                        <a href="{{ route('courses.show', $student['course']['id']) }}"
                            class="flex items-center gap-2.5 p-3 rounded-lg border border-ink-200 dark:border-ink-800 hover:border-ink-300 dark:hover:border-ink-700 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-all text-sm">
                            <span class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                            Ver curso
                        </a>
                    @endif
                    <a href="{{ route('students.edit', $student['id']) }}"
                        class="flex items-center gap-2.5 p-3 rounded-lg border border-ink-200 dark:border-ink-800 hover:border-ink-300 dark:hover:border-ink-700 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-all text-sm">
                        <span class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z" />
                            </svg>
                        </span>
                        Editar estudiante
                    </a>
                </div>
            </x-card>
        </div>
    </div>

@endsection