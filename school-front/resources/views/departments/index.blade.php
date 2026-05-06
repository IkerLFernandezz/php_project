@extends('layouts.app')

@section('content')

    <x-page-header title="Departamentos">
        <x-slot:actions>
            <x-button :href="route('departments.create')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo departamento
            </x-button>
        </x-slot:actions>
    </x-page-header>

    @if (count($departments) === 0)
        <x-card>
            <x-empty-state title="Aún no hay departamentos"
                description="Crea el primer departamento para organizar a los profesores." :icon="'<svg class=&quot;w-5 h-5 text-ink-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M3 7h18M3 12h18M3 17h18&quot;/></svg>'">
                <x-slot:actions>
                    <x-button :href="route('departments.create')">Nuevo departamento</x-button>
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
                            class="text-right px-5 py-3 text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wide w-40">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                    @foreach ($departments as $i => $department)
                        <tr class="group hover:bg-ink-50/50 dark:hover:bg-ink-950/50 transition-colors animate-fade-in"
                            style="animation-delay: {{ $i * 30 }}ms">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('departments.show', $department['id']) }}"
                                    class="font-medium hover:text-accent transition-colors">
                                    {{ $department['name'] }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div
                                    class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('departments.show', $department['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Ver</a>
                                    <a href="{{ route('departments.edit', $department['id']) }}"
                                        class="px-2.5 py-1 text-xs font-medium rounded-md text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-800 transition-colors">Editar</a>
                                    <span class="px-2.5 py-1">
                                        <x-confirm-delete :action="route('departments.destroy', $department['id'])"
                                            title="¿Eliminar departamento?"
                                            message="Los profesores asociados pueden verse afectados." />
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