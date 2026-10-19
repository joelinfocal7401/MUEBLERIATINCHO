<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'Panel administrativo') - Mueblería Tincho
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >
        {{--  móviles --}}
        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 lg:hidden"
        ></div>

        <x-admin.sidebar />

        {{-- Área principal --}}
        <div class="min-h-screen lg:pl-64">

            <x-admin.navbar />


            {{-- Contenido de la página --}}
            <main class="p-4 sm:p-6 lg:p-8">

                <div class="mx-auto w-full max-w-7xl">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

</body>

</html>