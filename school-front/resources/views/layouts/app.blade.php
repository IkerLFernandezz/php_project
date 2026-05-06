<!DOCTYPE html>
<html lang="es" x-data x-bind:class="$store.theme.dark ? 'dark' : ''">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'School Hub' }}</title>
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        ink: {
                            50: '#fafafa',
                            100: '#f5f5f5',
                            200: '#e5e5e5',
                            300: '#d4d4d4',
                            400: '#a3a3a3',
                            500: '#737373',
                            600: '#525252',
                            700: '#404040',
                            800: '#262626',
                            900: '#171717',
                            950: '#0a0a0a',
                        },
                        accent: {
                            DEFAULT: '#0070f3',
                            hover: '#0061d5',
                        },
                    },
                    boxShadow: {
                        'soft': '0 1px 2px 0 rgb(0 0 0 / 0.04), 0 1px 6px -1px rgb(0 0 0 / 0.06)',
                        'lift': '0 2px 4px -1px rgb(0 0 0 / 0.06), 0 4px 12px -2px rgb(0 0 0 / 0.08)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 200ms ease-out',
                        'slide-up': 'slideUp 250ms cubic-bezier(0.16, 1, 0.3, 1)',
                        'slide-down': 'slideDown 200ms cubic-bezier(0.16, 1, 0.3, 1)',
                        'scale-in': 'scaleIn 150ms cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(8px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-8px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.96)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                    },
                },
            },
        };
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                dark: localStorage.getItem('theme') === 'dark'
                    || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                toggle() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                },
            });
        });
        if (localStorage.getItem('theme') === 'dark'
            || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }

        ::selection {
            background-color: #0070f3;
            color: white;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(0 0 0 / 0.1);
            border-radius: 8px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(0 0 0 / 0.2);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: rgb(255 255 255 / 0.15);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: rgb(255 255 255 / 0.25);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        @media (prefers-reduced-motion: no-preference) {

            ::view-transition-old(root),
            ::view-transition-new(root) {
                animation-duration: 200ms;
            }
        }
    </style>
</head>

<body class="bg-white dark:bg-ink-950 text-ink-900 dark:text-ink-100 font-sans antialiased min-h-screen flex flex-col">

    @include('partials.nav')

    <main class="flex-1 max-w-7xl w-full mx-auto px-6 py-10">
        <div class="animate-slide-up">
            <x-flash />
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

</body>

</html>