@props(['name', 'label' => null, 'type' => 'text', 'required' => false, 'help' => null])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-ink-700 dark:text-ink-300 mb-1.5">
            {{ $label }}
            @if ($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' => 'w-full h-10 px-3 text-sm bg-white dark:bg-ink-950 text-ink-900 dark:text-ink-100 border border-ink-200 dark:border-ink-800 rounded-md transition-colors placeholder:text-ink-400 focus:outline-none focus:border-ink-400 dark:focus:border-ink-600 focus:ring-2 focus:ring-ink-900/5 dark:focus:ring-white/10'
        ]) }}>

    @if ($help)
        <p class="text-xs text-ink-500 mt-1.5">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-xs text-red-600 dark:text-red-400 mt-1.5 flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>