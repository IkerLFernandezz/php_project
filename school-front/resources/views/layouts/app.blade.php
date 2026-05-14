<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'School Hub' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                var isDark = stored === 'dark' || (!stored && prefersDark);
                if (isDark) document.documentElement.classList.add('dark');
            } catch (e) { }
        })();

        window.toggleTheme = function () {
            var root = document.documentElement;
            var nowDark = !root.classList.contains('dark');
            root.classList.toggle('dark', nowDark);
            try { localStorage.setItem('theme', nowDark ? 'dark' : 'light'); } catch (e) { }
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: nowDark } }));
        };
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700&family=Inter+Tight:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter Tight', 'system-ui', 'sans-serif'],
                        display: ['Bricolage Grotesque', 'Inter Tight', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        ink: {
                            50: '#fafaf9',
                            100: '#f4f4f2',
                            200: '#e7e5e1',
                            300: '#d6d3cd',
                            400: '#a8a29a',
                            500: '#78716c',
                            600: '#57534e',
                            700: '#3f3d3a',
                            800: '#272624',
                            900: '#1c1b19',
                            950: '#0e0d0c',
                        },
                        accent: {
                            DEFAULT: '#4f46e5',
                            hover: '#4338ca',
                            soft: '#eef2ff',
                            softDark: '#1e1b4b',
                        },
                    },
                    boxShadow: {
                        'soft': '0 1px 2px 0 rgb(0 0 0 / 0.04), 0 1px 6px -1px rgb(0 0 0 / 0.06)',
                        'lift': '0 2px 4px -1px rgb(0 0 0 / 0.06), 0 4px 16px -4px rgb(0 0 0 / 0.10)',
                        'glow': '0 0 0 1px rgb(79 70 229 / 0.15), 0 8px 24px -8px rgb(79 70 229 / 0.35)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 200ms ease-out',
                        'slide-up': 'slideUp 250ms cubic-bezier(0.16, 1, 0.3, 1)',
                        'slide-down': 'slideDown 200ms cubic-bezier(0.16, 1, 0.3, 1)',
                        'scale-in': 'scaleIn 150ms cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(8px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideDown: { '0%': { opacity: '0', transform: 'translateY(-8px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        scaleIn: { '0%': { opacity: '0', transform: 'scale(0.96)' }, '100%': { opacity: '1', transform: 'scale(1)' } },
                    },
                },
            },
        };
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }

        h1,
        h2,
        h3 {
            font-family: 'Bricolage Grotesque', 'Inter Tight', sans-serif;
            letter-spacing: -0.015em;
        }

        ::selection {
            background-color: #4f46e5;
            color: white;
        }

        .header-edge {
            background-image: linear-gradient(to right,
                    transparent 0%,
                    rgb(79 70 229 / 0.35) 30%,
                    rgb(79 70 229 / 0.55) 50%,
                    rgb(79 70 229 / 0.35) 70%,
                    transparent 100%);
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(0 0 0 / 0.10);
            border-radius: 8px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(0 0 0 / 0.20);
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

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-ink-50 dark:bg-ink-950 text-ink-900 dark:text-ink-100 font-sans antialiased min-h-screen flex flex-col">

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