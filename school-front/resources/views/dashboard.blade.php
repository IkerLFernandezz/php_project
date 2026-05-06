@extends('layouts.app')

@section('content')

<div class="mb-10">
    <h1 class="text-3xl font-semibold tracking-tight">Panel de control</h1>
    <p class="text-ink-500 dark:text-ink-400 mt-1">Resumen general del centro educativo.</p>
</div>

{{-- Stats grid --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-10">
    @foreach ([
        ['label' => 'Cursos',         'value' => $stats['courses'],     'route' => 'courses.index',     'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
        ['label' => 'Estudiantes',    'value' => $stats['students'],    'route' => 'students.index',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>'],
        ['label' => 'Profesores',     'value' => $stats['teachers'],    'route' => 'teachers.index',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>'],
        ['label' => 'Asignaturas',    'value' => $stats['subjects'],    'route' => 'subjects.index',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2h-5L9 3H4a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
        ['label' => 'Departamentos',  'value' => $stats['departments'], 'route' => 'departments.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
    ] as $stat)
        <a href="{{ route($stat['route']) }}"
           class="group bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 rounded-xl p-5 hover:shadow-lift hover:border-ink-300 dark:hover:border-ink-700 transition-all duration-200">
            <div class="flex items-center justify-between mb-3">
                <span class="w-8 h-8 rounded-lg bg-ink-100 dark:bg-ink-800 flex items-center justify-center text-ink-600 dark:text-ink-400 group-hover:bg-ink-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-ink-900 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                </span>
                <svg class="w-3.5 h-3.5 text-ink-400 group-hover:text-ink-900 dark:group-hover:text-white group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </div>
            <div class="text-3xl font-semibold tracking-tight tabular-nums">{{ $stat['value'] }}</div>
            <div class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">{{ $stat['label'] }}</div>
        </a>
    @endforeach
</div>

{{-- Two columns: estudiantes + asignaturas --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 rounded-xl">
        <div class="flex items-center justify-between p-5 border-b border-ink-200 dark:border-ink-800">
            <h2 class="font-semibold">Estudiantes</h2>
            <a href="{{ route('students.index') }}" class="text-xs font-medium text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">Ver todos →</a>
        </div>
        <div class="divide-y divide-ink-200 dark:divide-ink-800">
            @forelse ($recentStudents as $s)
                <a href="{{ route('students.show', $s['id']) }}" class="flex items-center gap-3 p-4 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-ink-200 to-ink-300 dark:from-ink-700 dark:to-ink-800 flex items-center justify-center text-xs font-semibold text-ink-700 dark:text-ink-200">
                        {{ strtoupper(substr($s['name'], 0, 1) . substr($s['surname'], 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-sm truncate">{{ $s['name'] }} {{ $s['surname'] }}</div>
                        <div class="text-xs text-ink-500 truncate">{{ $s['mail'] }}</div>
                    </div>
                    <x-badge variant="neutral">{{ $s['course']['name'] ?? '—' }}</x-badge>
                </a>
            @empty
                <div class="p-8 text-center text-sm text-ink-500">Sin estudiantes.</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 rounded-xl">
        <div class="flex items-center justify-between p-5 border-b border-ink-200 dark:border-ink-800">
            <h2 class="font-semibold">Asignaturas</h2>
            <a href="{{ route('subjects.index') }}" class="text-xs font-medium text-ink-500 hover:text-ink-900 dark:hover:text-white transition-colors">Ver todas →</a>
        </div>
        <div class="divide-y divide-ink-200 dark:divide-ink-800">
            @forelse ($recentSubjects as $sub)
                <a href="{{ route('subjects.show', $sub['id']) }}" class="flex items-center gap-3 p-4 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors">
                    <div class="w-9 h-9 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                        <svg class="w-4 h-4 text-ink-600 dark:text-ink-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-sm truncate">{{ $sub['name'] }}</div>
                        <div class="text-xs text-ink-500 truncate">
                            {{ $sub['course']['name'] ?? '—' }} · {{ $sub['teacher']['name'] ?? '' }} {{ $sub['teacher']['surname'] ?? '' }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-sm text-ink-500">Sin asignaturas.</div>
            @endforelse
        </div>
    </div>

</div>

@endsection