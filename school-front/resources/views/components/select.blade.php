@props(['name', 'label' => null, 'required' => false, 'help' => null])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-ink-700 dark:text-ink-300 mb-1.5">
            {{ $label }}
            @if ($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif {{ $attributes->merge([
    'class' => 'w-full h-10 px-3 text-sm bg-white dark:bg-ink-950 text-ink-900 dark:text-ink-100 border border-ink-200 dark:border-ink-800 rounded-md transition-colors focus:outline-none focus:border-ink-400 dark:focus:border-ink-600 focus:ring-2 focus:ring-ink-900/5 dark:focus:ring-white/10'
]) }}>
        {{ $slot }}
    </select>

    @if ($help)
        <p class="text-xs text-ink-500 mt-1.5">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-xs text-red-600 dark:text-red-400 mt-1.5">{{ $message }}</p>
    @enderror
</div>