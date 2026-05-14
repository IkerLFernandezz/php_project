<header x-data="{ mobile: false }"
    class="sticky top-0 z-40 border-b border-ink-200 dark:border-ink-800 bg-white/85 dark:bg-ink-950/85 backdrop-blur-md">

    <div class="header-edge h-px w-full"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Brand --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent to-accent-hover flex items-center justify-center transition-transform group-hover:scale-105 shadow-glow">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                    </svg>
                </div>
                <span class="font-display font-semibold text-base tracking-tight">School Hub</span>
            </a>

            {{-- Only show nav if user is logged in --}}
            @if (session('google_id_token'))
                <nav class="hidden md:flex items-center gap-1 text-sm">
                    <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')">Cursos</x-nav-link>
                    <x-nav-link :href="route('teachers.index')"
                        :active="request()->routeIs('teachers.*')">Profesores</x-nav-link>
                    <x-nav-link :href="route('students.index')"
                        :active="request()->routeIs('students.*')">Estudiantes</x-nav-link>
                    <x-nav-link :href="route('subjects.index')"
                        :active="request()->routeIs('subjects.*')">Asignaturas</x-nav-link>
                    <x-nav-link :href="route('departments.index')"
                        :active="request()->routeIs('departments.*')">Departamentos</x-nav-link>
                </nav>
            @else
                <div class="flex-1"></div>
            @endif

            {{-- Right side --}}
            <div class="flex items-center gap-1">

                {{-- Theme toggle --}}
                <button type="button" onclick="window.toggleTheme()"
                    x-data="{ dark: document.documentElement.classList.contains('dark') }"
                    @theme-changed.window="dark = $event.detail.dark"
                    class="w-9 h-9 rounded-md flex items-center justify-center text-ink-600 dark:text-ink-400 hover:text-ink-900 dark:hover:text-white hover:bg-ink-100 dark:hover:bg-ink-900 transition-colors"
                    title="Cambiar tema" aria-label="Cambiar tema">
                    <svg x-show="!dark" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="dark" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                {{-- User menu / login --}}
                @if (session('google_id_token'))
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative ml-2">
                        <button type="button" @click="open = !open"
                            class="flex items-center gap-2 h-9 pl-1 pr-2 rounded-full hover:bg-ink-100 dark:hover:bg-ink-900 transition-colors"
                            aria-label="Menú de usuario">
                            @if (session('user.picture'))
                                <img src="{{ session('user.picture') }}" alt=""
                                    class="w-7 h-7 rounded-full ring-1 ring-ink-200 dark:ring-ink-800"
                                    referrerpolicy="no-referrer">
                            @else
                                <span
                                    class="w-7 h-7 rounded-full bg-accent text-white text-xs font-semibold flex items-center justify-center">
                                    {{ mb_strtoupper(mb_substr(session('user.name', 'U'), 0, 1)) }}
                                </span>
                            @endif
                            <svg class="w-3.5 h-3.5 text-ink-500 transition-transform" :class="{ 'rotate-180': open }"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute right-0 mt-1 w-60 rounded-lg bg-white dark:bg-ink-900 shadow-lift border border-ink-200 dark:border-ink-800 py-2 z-50">

                            <div class="px-3 py-2 border-b border-ink-200 dark:border-ink-800">
                                <div class="text-sm font-medium truncate">{{ session('user.name') }}</div>
                                <div class="text-xs text-ink-500 dark:text-ink-400 truncate">{{ session('user.email') }}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="px-1 pt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-2 py-1.5 rounded-md text-sm hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-ink-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="ml-2 h-9 px-4 inline-flex items-center text-sm font-medium rounded-md bg-ink-900 text-white dark:bg-white dark:text-ink-900 hover:opacity-90 transition-opacity shadow-soft">
                        Iniciar sesión
                    </a>
                @endif

                {{-- Mobile hamburger --}}
                @if (session('google_id_token'))
                    <button type="button" @click="mobile = !mobile" :aria-expanded="mobile.toString()" aria-label="Menú"
                        class="md:hidden w-9 h-9 rounded-md flex items-center justify-center text-ink-600 dark:text-ink-400 hover:bg-ink-100 dark:hover:bg-ink-900">
                        <svg x-show="!mobile" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobile" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    @if (session('google_id_token'))
        <div x-show="mobile" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden border-t border-ink-200 dark:border-ink-800 px-4 py-3 space-y-1 bg-white dark:bg-ink-950">

            @php
                $mobileLinks = [
                    ['route' => 'courses.index', 'pattern' => 'courses.*', 'label' => 'Cursos'],
                    ['route' => 'teachers.index', 'pattern' => 'teachers.*', 'label' => 'Profesores'],
                    ['route' => 'students.index', 'pattern' => 'students.*', 'label' => 'Estudiantes'],
                    ['route' => 'subjects.index', 'pattern' => 'subjects.*', 'label' => 'Asignaturas'],
                    ['route' => 'departments.index', 'pattern' => 'departments.*', 'label' => 'Departamentos'],
                ];
            @endphp

            @foreach ($mobileLinks as $link)
                <a href="{{ route($link['route']) }}" class="block px-3 py-2 rounded-md text-sm font-medium transition-colors
                                        {{ request()->routeIs($link['pattern'])
                    ? 'bg-accent-soft text-accent dark:bg-accent-softDark dark:text-white'
                    : 'text-ink-700 dark:text-ink-300 hover:bg-ink-100 dark:hover:bg-ink-900' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    @endif
</header>