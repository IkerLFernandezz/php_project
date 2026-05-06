@extends('layouts.app')

@section('content')

    <x-page-header title="Profesores">
        <x-slot:actions>
            <x-button :href="route('teachers.create')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo profesor
            </x-button>
        </x-slot:actions>
    </x-page-header>

    @if (count($teachers) === 0)
        <x-card>
            <x-empty-state title="Aún no hay profesores"
                description="Añade el primer profesor para empezar a asignar asignaturas." :icon="'<svg class=&quot;w-5 h-5 text-ink-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z&quot;/></svg>'">
                <x-slot:actions>
                    <x-button :href="route('teachers.create')">Nuevo profesor</x-button>
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
                            Departamento</th>
                        <th
                            class="text-right px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide w-40">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                    @foreach ($teachers as $i => $teacher)
                        <tr class="group hover:bg-ink-50/50 dark:hover:bg-ink-950/50 transition-colors animate-fade-in"
                            style="animation-delay: {{ $i * 30 }}ms">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('teachers.show', $teacher['id']) }}"
                                    class="font-medium hover:text-accent transition-colors">
                                    {{ $teacher['name'] }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5 text-ink-700 dark:text-ink-300">{{ $teacher['surname'] }}</td>
                            <td class="px-5 py-3.5 font-mono text-xs text-ink-600 dark:text-ink-400">{{ $teacher['dni'] }}</td>
                            <td class="px-5 py-3.5 text-sm text-ink-600 dark:text-ink-400">{{ $teacher['mail'] }}</td>
                            <td class="px-5 py-3.5">
                                @if (!empty($teacher['department']['name']))
                                    <x-badge variant="warning">{{ $teacher['department']['name'] }}</x-badge>
                                @else
                                    <span class="text-ink-400 dark:text-ink-600 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div
                                    class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('teachers.show', $teacher['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Ver</a>
                                    <a href="{{ route('teachers.edit', $teacher['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Editar</a>
                                    <span class="px-2.5 py-1">
                                        <x-confirm-delete :action="route('teachers.destroy', $teacher['id'])"
                                            title="¿Eliminar profesor?"
                                            message="Las asignaturas asociadas pueden verse afectadas." />
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