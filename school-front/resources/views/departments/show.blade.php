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
                message="Los profesores asociados pueden verse afectados." />
        </x-slot:actions>
    </x-page-header>

    <div class="space-y-6">

        {{-- Department information --}}
        <x-card>
            <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide mb-4">Información</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                <div>
                    <dt class="text-xs text-ink-500 mb-1">Nombre</dt>
                    <dd class="font-medium">{{ $department['name'] }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-ink-500 mb-1">Identificador</dt>
                    <dd class="font-mono text-xs text-ink-600 dark:text-ink-400 break-all">{{ $department['id'] }}</dd>
                </div>
            </dl>
        </x-card>

        {{-- Teachers in this department --}}
        <x-card>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-ink-500 dark:text-ink-400 uppercase tracking-wide">
                    Profesores <span class="text-ink-400 ml-1">({{ count($teachers) }})</span>
                </h2>
                <x-button size="sm" variant="secondary" :href="route('teachers.create', ['departmentId' => $department['id']])">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Añadir
                </x-button>
            </div>

            @if (count($teachers) === 0)
                <p class="text-sm text-ink-500 dark:text-ink-400 py-2">Aún no hay profesores en este departamento.</p>
            @else
                <ul class="divide-y divide-ink-200 dark:divide-ink-800 -mx-2">
                    @foreach ($teachers as $teacher)
                        <li>
                            <a href="{{ route('teachers.show', $teacher['id']) }}"
                                class="flex items-center justify-between gap-4 px-2 py-2.5 rounded-md hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-8 h-8 rounded-full bg-ink-100 dark:bg-ink-800 flex items-center justify-center text-xs font-semibold text-ink-600 dark:text-ink-400 flex-shrink-0">
                                        {{ mb_substr($teacher['name'], 0, 1) }}{{ mb_substr($teacher['surname'] ?? '', 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-medium text-sm truncate">{{ $teacher['name'] }} {{ $teacher['surname'] }}
                                        </div>
                                        <div class="text-xs text-ink-500 dark:text-ink-400 truncate">{{ $teacher['mail'] }}</div>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-ink-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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