@extends('layouts.app')

@section('content')

    <x-page-header title="Cursos">
        <x-slot:actions>
            <x-button :href="route('courses.create')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo curso
            </x-button>
        </x-slot:actions>
    </x-page-header>

    @if (count($courses) === 0)
        <x-card>
            <x-empty-state title="Aún no hay cursos" description="Crea el primer curso para empezar a matricular estudiantes."
                :icon="'<svg class=&quot;w-5 h-5 text-ink-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253&quot;/></svg>'">
                <x-slot:actions>
                    <x-button :href="route('courses.create')">Nuevo curso</x-button>
                </x-slot:actions>
            </x-empty-state>
        </x-card>
    @else
        <div class="bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 rounded-xl overflow-hidden shadow-soft">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-800 bg-ink-50/50 dark:bg-ink-950/50">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">Nombre</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">Turno</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide w-40">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                    @foreach ($courses as $i => $course)
                        <tr class="group hover:bg-ink-50/50 dark:hover:bg-ink-950/50 transition-colors animate-fade-in"
                            style="animation-delay: {{ min($i, 20) * 30 }}ms">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('courses.show', $course['id']) }}"
                                    class="font-medium hover:text-accent transition-colors">
                                    {{ $course['name'] }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5">
                                @if ($course['schedule'] === 'Matí')
                                    <x-badge variant="warning">Mañana</x-badge>
                                @else
                                    <x-badge variant="info">Tarde</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('courses.show', $course['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Ver</a>
                                    <a href="{{ route('courses.edit', $course['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Editar</a>
                                    <span class="px-2.5 py-1">
                                        <x-confirm-delete :action="route('courses.destroy', $course['id'])" title="¿Eliminar curso?"
                                            message="Los estudiantes matriculados pueden verse afectados." />
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection