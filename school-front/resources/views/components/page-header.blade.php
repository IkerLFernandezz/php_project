@props(['title', 'description' => null])

<div class="flex items-end justify-between gap-4 mb-8 pb-6 border-b border-ink-200 dark:border-ink-800">
    <div>
        <h1 class="text-2xl font-semibold tracking-tight">{{ $title }}</h1>
        @if ($description)
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">{{ $description }}</p>
        @endif
    </div>
    @if (isset($actions))
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>