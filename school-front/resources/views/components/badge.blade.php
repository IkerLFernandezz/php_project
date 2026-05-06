@props(['variant' => 'neutral'])

@php
    $variants = [
        'neutral' => 'bg-ink-100 text-ink-700 dark:bg-ink-800 dark:text-ink-300',
        'success' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400',
        'warning' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-400',
        'danger' => 'bg-red-50 text-red-700 dark:bg-red-950/50 dark:text-red-400',
        'info' => 'bg-blue-50 text-blue-700 dark:bg-blue-950/50 dark:text-blue-400',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium ring-1 ring-inset ring-ink-200 dark:ring-ink-800 ' . ($variants[$variant] ?? $variants['neutral'])]) }}>
    {{ $slot }}
</span>