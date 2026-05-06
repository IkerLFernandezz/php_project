@props([
    'variant' => 'primary',
    'size' => 'md',
    'as' => 'button',
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center gap-1.5 font-medium rounded-md transition-all duration-150 active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-ink-900 dark:focus-visible:ring-white dark:focus-visible:ring-offset-ink-950';

    $variants = [
        'primary' => 'bg-ink-900 text-white hover:bg-ink-800 dark:bg-white dark:text-ink-900 dark:hover:bg-ink-100 shadow-soft',
        'secondary' => 'bg-white dark:bg-ink-900 text-ink-900 dark:text-white border border-ink-200 dark:border-ink-800 hover:bg-ink-50 dark:hover:bg-ink-800',
        'ghost' => 'text-ink-700 dark:text-ink-300 hover:bg-ink-100 dark:hover:bg-ink-900',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 shadow-soft',
        'subtle-danger' => 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/40',
    ];

    $sizes = [
        'sm' => 'h-8 px-3 text-xs',
        'md' => 'h-9 px-4 text-sm',
        'lg' => 'h-11 px-5 text-sm',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
            {{ $slot }}
        </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif