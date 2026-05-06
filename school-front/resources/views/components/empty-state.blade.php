@props(['title', 'description' => null, 'icon' => null])

<div class="flex flex-col items-center justify-center py-16 text-center animate-fade-in">
    <div class="w-12 h-12 rounded-xl bg-ink-100 dark:bg-ink-900 flex items-center justify-center mb-4">
        @if ($icon)
            {!! $icon !!}
        @else
            <svg class="w-5 h-5 text-ink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        @endif
    </div>
    <h3 class="text-base font-semibold text-ink-900 dark:text-white">{{ $title }}</h3>
    @if ($description)
        <p class="text-sm text-ink-500 dark:text-ink-400 mt-1 max-w-sm">{{ $description }}</p>
    @endif
    @if (isset($actions))
        <div class="mt-5">{{ $actions }}</div>
    @endif
</div>