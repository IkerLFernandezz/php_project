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

    <x-page-header title="{{ $teacher['name'] }} {{ $teacher['surname'] }}">
        <x-slot:actions>
            <x-button variant="secondary" :href="route('teachers.edit', $teacher['id'])">Editar</x-button>
            <x-confirm-delete :action="route('teachers.destroy', $teacher['id'])" title="¿Eliminar profesor?"
                message="Esta acción no se puede deshacer." />
        </x-slot:actions>
    </x-page-header>

    <div class="space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <x-card>
                    <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Información</h2>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                        <div>
                            <dt class="text-xs text-ink-500 mb-1">Nombre</dt>
                            <dd class="font-medium">{{ $teacher['name'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-ink-500 mb-1">Apellido</dt>
                            <dd class="font-medium">{{ $teacher['surname'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-ink-500 mb-1">DNI</dt>
                            <dd class="font-mono text-sm">{{ $teacher['dni'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-ink-500 mb-1">Correo</dt>
                            <dd class="text-sm">{{ $teacher['mail'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-ink-500 mb-1">Departamento</dt>
                            <dd>
                                @if (!empty($teacher['department']['name']))
                                    <x-badge variant="warning">{{ $teacher['department']['name'] }}</x-badge>
                                @else
                                    <span class="text-ink-400 dark:text-ink-600 text-sm">Sin asignar</span>
                                @endif
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-xs text-ink-500 mb-1">Identificador</dt>
                            <dd class="font-mono text-xs text-ink-600 dark:text-ink-400 break-all">{{ $teacher['id'] }}</dd>
                        </div>
                    </dl>
                </x-card>
            </div>

            <div>
                <x-card>
                    <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Navegación</h2>
                    <div class="space-y-2">
                        @if (!empty($teacher['department']['id']))
                            <a href="{{ route('departments.show', $teacher['department']['id']) }}"
                                class="flex items-center gap-2.5 p-3 rounded-lg border border-ink-200 dark:border-ink-800 hover:border-ink-300 dark:hover:border-ink-700 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-all text-sm">
                                <span class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>
                                </span>
                                Ver departamento
                            </a>
                        @else
                            <p class="text-sm text-ink-500 dark:text-ink-400 p-3">Este profesor no tiene departamento asignado.</p>
                        @endif
                    </div>
                </x-card>
            </div>
        </div>

        {{-- Subjects taught by this teacher --}}
        <x-card>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide">
                    Asignaturas que imparte <span class="text-ink-400 ml-1">({{ count($subjects) }})</span>
                </h2>
                <x-button size="sm" variant="secondary"
                    :href="route('subjects.create', ['teacherId' => $teacher['id']])">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Asignar
                </x-button>
            </div>

            @if (count($subjects) === 0)
                <p class="text-sm text-ink-500 dark:text-ink-400 py-2">Este profesor no imparte ninguna asignatura todavía.</p>
            @else
                <ul class="divide-y divide-ink-200 dark:divide-ink-800 -mx-2">
                    @foreach ($subjects as $subject)
                        <li>
                            <a href="{{ route('subjects.show', $subject['id']) }}"
                                class="flex items-center justify-between gap-4 px-2 py-2.5 rounded-md hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-8 h-8 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5 text-ink-600 dark:text-ink-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex items-center gap-3 flex-wrap">
                                        <div class="font-medium text-sm">{{ $subject['name'] }}</div>
                                        @if (!empty($subject['course']['name']))
                                            <x-badge variant="info">{{ $subject['course']['name'] }}</x-badge>
                                        @endif
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-ink-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-card>

    </div>

@endsection