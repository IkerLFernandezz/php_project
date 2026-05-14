@props(['href', 'active' => false])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => 'relative px-3 py-2 rounded-md font-medium transition-colors '
        . ($active
            ? 'text-ink-900 dark:text-white'
            : 'text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900'
        )
]) }}>
    {{ $slot }}
    @if ($active)
        <span class="absolute left-3 right-3 -bottom-[17px] h-0.5 bg-accent rounded-full"></span>
    @endif
</a>