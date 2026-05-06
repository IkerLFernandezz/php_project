<header
    class="sticky top-0 z-40 border-b border-ink-200 dark:border-ink-800 bg-white/80 dark:bg-ink-950/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <div
                    class="w-8 h-8 rounded-lg bg-ink-900 dark:bg-white flex items-center justify-center transition-transform group-hover:scale-105">
                    <svg class="w-4 h-4 text-white dark:text-ink-900" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                    </svg>
                </div>
                <span class="font-semibold text-base tracking-tight">School Hub</span>
            </a>

            <nav class="hidden md:flex items-center gap-1 text-sm">
                <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')">
                    Cursos
                </x-nav-link>

                <div x-data="{ open: false }" class="relative" @mouseleave="open = false">
                    <button @mouseenter="open = true" @click="open = !open"
                        class="px-3 py-2 rounded-md font-medium text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900 transition-colors flex items-center gap-1.5"
                        :class="{ 'text-ink-900 dark:text-white bg-ink-100 dark:bg-ink-900': open || {{ request()->routeIs('teachers.*', 'students.*') ? 'true' : 'false' }} }">
                        Personas
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute left-0 mt-1 w-56 origin-top-left rounded-lg bg-white dark:bg-ink-900 shadow-lift border border-ink-200 dark:border-ink-800 py-1.5 z-50">
                        <a href="{{ route('teachers.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                            <span
                                class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-ink-600 dark:text-ink-400" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <div>
                                <div class="font-medium">Profesores</div>
                                <div class="text-xs text-ink-500">Personal docente</div>
                            </div>
                        </a>
                        <a href="{{ route('students.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                            <span
                                class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-ink-600 dark:text-ink-400" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </span>
                            <div>
                                <div class="font-medium">Estudiantes</div>
                                <div class="text-xs text-ink-500">Matriculados</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative" @mouseleave="open = false">
                    <button @mouseenter="open = true" @click="open = !open"
                        class="px-3 py-2 rounded-md font-medium text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900 transition-colors flex items-center gap-1.5"
                        :class="{ 'text-ink-900 dark:text-white bg-ink-100 dark:bg-ink-900': open || {{ request()->routeIs('subjects.*', 'departments.*') ? 'true' : 'false' }} }">
                        Académico
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute left-0 mt-1 w-56 origin-top-left rounded-lg bg-white dark:bg-ink-900 shadow-lift border border-ink-200 dark:border-ink-800 py-1.5 z-50">
                        <a href="{{ route('subjects.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                            <span
                                class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-ink-600 dark:text-ink-400" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                            <div>
                                <div class="font-medium">Asignaturas</div>
                                <div class="text-xs text-ink-500">Módulos y unidades</div>
                            </div>
                        </a>
                        <a href="{{ route('departments.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                            <span
                                class="w-7 h-7 rounded-md bg-ink-100 dark:bg-ink-800 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-ink-600 dark:text-ink-400" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </span>
                            <div>
                                <div class="font-medium">Departamentos</div>
                                <div class="text-xs text-ink-500">Unidades organizativas</div>
                            </div>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-1">

                <button @click="$store.theme.toggle()"
                    class="w-9 h-9 rounded-md flex items-center justify-center text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900 transition-colors"
                    title="Cambiar tema">
                    <svg x-show="!$store.theme.dark" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="$store.theme.dark" x-cloak class="w-4 h-4" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <button @click="$dispatch('mobile-menu-toggle')"
                    class="md:hidden w-9 h-9 rounded-md flex items-center justify-center text-ink-600 dark:text-ink-400 hover:bg-ink-100 dark:hover:bg-ink-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" @mobile-menu-toggle.window="open = !open" x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden border-t border-ink-200 dark:border-ink-800 px-6 py-3 space-y-1 bg-white dark:bg-ink-950">
        <a href="{{ route('courses.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-ink-100 dark:hover:bg-ink-900">Cursos</a>
        <a href="{{ route('teachers.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-ink-100 dark:hover:bg-ink-900">Profesores</a>
        <a href="{{ route('students.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-ink-100 dark:hover:bg-ink-900">Estudiantes</a>
        <a href="{{ route('subjects.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-ink-100 dark:hover:bg-ink-900">Asignaturas</a>
        <a href="{{ route('departments.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-ink-100 dark:hover:bg-ink-900">Departamentos</a>
    </div>
</header>