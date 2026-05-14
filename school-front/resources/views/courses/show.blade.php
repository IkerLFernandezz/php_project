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

    <x-page-header title="{{ $course['name'] }}">
        <x-slot:actions>
            <x-button variant="secondary" :href="route('courses.edit', $course['id'])">Editar</x-button>
            <x-confirm-delete :action="route('courses.destroy', $course['id'])" title="¿Eliminar curso?"
                message="Esta acción no se puede deshacer." />
        </x-slot:actions>
    </x-page-header>

    <div class="space-y-6">

        {{-- Course information --}}
        <x-card>
            <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Información</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-5">
                <div>
                    <dt class="text-xs text-ink-500 mb-1">Nombre</dt>
                    <dd class="font-medium">{{ $course['name'] }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-ink-500 mb-1">Turno</dt>
                    <dd>
                        @if ($course['schedule'] === 'Matí')
                            <x-badge variant="warning">Mañana</x-badge>
                        @else
                            <x-badge variant="info">Tarde</x-badge>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs text-ink-500 mb-1">Identificador</dt>
                    <dd class="font-mono text-xs text-ink-600 dark:text-ink-400 break-all">{{ $course['id'] }}</dd>
                </div>
            </dl>
        </x-card>

        {{-- Students enrolled in this course --}}
        <x-card>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide">
                    Estudiantes <span class="text-ink-400 ml-1">({{ count($students) }})</span>
                </h2>
                <x-button size="sm" variant="secondary"
                    :href="route('students.create', ['courseId' => $course['id']])">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Matricular
                </x-button>
            </div>

            @if (count($students) === 0)
                <p class="text-sm text-ink-500 dark:text-ink-400 py-2">Aún no hay estudiantes matriculados en este curso.</p>
            @else
                <ul class="divide-y divide-ink-200 dark:divide-ink-800 -mx-2">
                    @foreach ($students as $student)
                        <li>
                            <a href="{{ route('students.show', $student['id']) }}"
                                class="flex items-center justify-between gap-4 px-2 py-2.5 rounded-md hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-8 h-8 rounded-full bg-ink-100 dark:bg-ink-800 flex items-center justify-center text-xs font-semibold text-ink-600 dark:text-ink-400 flex-shrink-0">
                                        {{ mb_substr($student['name'], 0, 1) }}{{ mb_substr($student['surname'] ?? '', 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-medium text-sm truncate">{{ $student['name'] }} {{ $student['surname'] }}</div>
                                        <div class="text-xs text-ink-500 dark:text-ink-400 font-mono">{{ $student['dni'] }}</div>
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

        {{-- Subjects taught in this course --}}
        <x-card>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide">
                    Asignaturas <span class="text-ink-400 ml-1">({{ count($subjects) }})</span>
                </h2>
                <x-button size="sm" variant="secondary"
                    :href="route('subjects.create', ['courseId' => $course['id']])">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Añadir
                </x-button>
            </div>

            @if (count($subjects) === 0)
                <p class="text-sm text-ink-500 dark:text-ink-400 py-2">Aún no hay asignaturas en este curso.</p>
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
                                    <div class="min-w-0">
                                        <div class="font-medium text-sm truncate">{{ $subject['name'] }}</div>
                                        <div class="text-xs text-ink-500 dark:text-ink-400 truncate">
                                            @if (!empty($subject['teacher']['name']))
                                                {{ $subject['teacher']['name'] }} {{ $subject['teacher']['surname'] ?? '' }}
                                            @else
                                                Sin profesor asignado
                                            @endif
                                        </div>
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