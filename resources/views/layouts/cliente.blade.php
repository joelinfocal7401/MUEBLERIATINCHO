
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel del cliente') - Mueblería Tincho</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen">

        {{-- Fondo oscuro del menú móvil --}}
        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            @keydown.escape.window="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-950/50 md:hidden"
            aria-hidden="true">
        </div>

        {{-- Sidebar: cajón móvil y menú fijo en escritorio --}}
        <div
            class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            @keydown.escape.window="sidebarOpen = false">

            @include('components.cliente.sidebar')
        </div>

        {{-- Área principal --}}
        <div class="min-h-screen md:pl-64">

            {{-- Navbar --}}
            @include('components.cliente.navbar')

            {{-- Contenido de cada vista --}}
            <main class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            {{-- Pie de página --}}
            <footer class="border-t border-slate-200 bg-white px-4 py-5 text-center text-xs text-slate-500 sm:px-6">
                © {{ date('Y') }} Mueblería Tincho. Todos los derechos reservados.
            </footer>

        </div>
    </div>

</body>
</html>
