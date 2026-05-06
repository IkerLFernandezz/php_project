@extends('layouts.app')

@section('content')

    <x-page-header title="Estudiantes">
        <x-slot:actions>
            <x-button :href="route('students.create')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo estudiante
            </x-button>
        </x-slot:actions>
    </x-page-header>

    @if (count($students) === 0)
        <x-card>
            <x-empty-state title="Aún no hay estudiantes" description="Matricula al primer estudiante para empezar."
                :icon="'<svg class=&quot;w-5 h-5 text-ink-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6 0a4 4 0 100-8 4 4 0 000 8z&quot;/></svg>'">
                <x-slot:actions>
                    <x-button :href="route('students.create')">Nuevo estudiante</x-button>
                </x-slot:actions>
            </x-empty-state>
        </x-card>
    @else
        <div class="bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 rounded-xl overflow-hidden shadow-soft">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-800 bg-ink-50/50 dark:bg-ink-950/50">
                        <th
                            class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">
                            Nombre</th>
                        <th
                            class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">
                            Apellido</th>
                        <th
                            class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">
                            DNI</th>
                        <th
                            class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">
                            Correo</th>
                        <th
                            class="text-left px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide">
                            Curso</th>
                        <th
                            class="text-right px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide w-40">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                    @foreach ($students as $i => $student)
                        <tr class="group hover:bg-ink-50/50 dark:hover:bg-ink-950/50 transition-colors animate-fade-in"
                            style="animation-delay: {{ $i * 30 }}ms">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('students.show', $student['id']) }}"
                                    class="font-medium hover:text-accent transition-colors">
                                    {{ $student['name'] }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5 text-ink-700 dark:text-ink-300">{{ $student['surname'] }}</td>
                            <td class="px-5 py-3.5 font-mono text-xs text-ink-600 dark:text-ink-400">{{ $student['dni'] }}</td>
                            <td class="px-5 py-3.5 text-sm text-ink-600 dark:text-ink-400">{{ $student['mail'] }}</td>
                            <td class="px-5 py-3.5">
                                @if (!empty($student['course']['name']))
                                    <x-badge variant="info">{{ $student['course']['name'] }}</x-badge>
                                @else
                                    <span class="text-ink-400 dark:text-ink-600 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div
                                    class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('students.show', $student['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Ver</a>
                                    <a href="{{ route('students.edit', $student['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Editar</a>
                                    <span class="px-2.5 py-1">
                                        <x-confirm-delete :action="route('students.destroy', $student['id'])"
                                            title="¿Eliminar estudiante?" message="Esta acción no se puede deshacer." />
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