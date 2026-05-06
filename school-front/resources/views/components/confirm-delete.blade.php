@props(['action', 'title' => 'Delete this item?', 'message' => 'This action cannot be undone.'])

<div x-data="{ open: false }" class="inline">
    <button type="button" @click="open = true"
        class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 text-sm font-medium transition-colors">
        Delete
    </button>

    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="open = false"
                class="fixed inset-0 bg-ink-950/60 backdrop-blur-sm"></div>

            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-md bg-white dark:bg-ink-900 rounded-xl shadow-lift border border-ink-200 dark:border-ink-800 p-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-950/50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold">{{ $title }}</h3>
                        <p class="text-sm text-ink-600 dark:text-ink-400 mt-1">{{ $message }}</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="open = false"
                        class="h-9 px-4 text-sm font-medium rounded-md bg-white dark:bg-ink-900 border border-ink-200 dark:border-ink-800 hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                        Cancel
                    </button>
                    <form method="POST" action="{{ $action }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="h-9 px-4 text-sm font-medium rounded-md bg-red-600 text-white hover:bg-red-700 transition-colors shadow-soft">
                            Yes, delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>