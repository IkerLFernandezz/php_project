@props(['href', 'active' => false])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => 'px-3 py-2 rounded-md font-medium transition-colors '
        . ($active
            ? 'text-ink-900 dark:text-white bg-ink-100 dark:bg-ink-900'
            : 'text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900'
        )
]) }}>
    {{ $slot }}
</a>