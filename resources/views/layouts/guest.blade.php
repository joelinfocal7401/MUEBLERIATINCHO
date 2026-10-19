<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Mueblería Tincho') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fuente --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="min-h-screen overflow-x-hidden bg-[#1b1714] font-['Inter'] text-[#292521]">

    {{-- ============================================================
         FONDO
    ============================================================ --}}

    <div class="fixed inset-0 -z-20 bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=2000&q=85')]">
    </div>

    {{-- Capa oscura + degradado --}}
    <div class="fixed inset-0 -z-10 bg-gradient-to-br from-[#171411]/95 via-[#211b17]/85 to-[#8d542f]/45">
    </div>

    {{-- Patrón de puntos --}}
    <div
        class="fixed inset-0 -z-10 opacity-20
        bg-[radial-gradient(circle_at_1px_1px,rgba(255,255,255,0.25)_1px,transparent_0)]
        bg-[length:22px_22px]">
    </div>


    {{-- ============================================================
         CONTENEDOR PRINCIPAL
    ============================================================ --}}

    <div class="relative min-h-screen">


        {{-- ========================================================
             BOTÓN VOLVER
        ======================================================== --}}

        <a
            href="{{ url('/') }}"
            class="absolute left-5 top-5 z-20
                   inline-flex items-center gap-2
                   rounded-full
                   border border-white/20
                   bg-black/20
                   px-4 py-2
                   text-xs font-medium text-white/80
                   backdrop-blur-md
                   transition duration-300
                   hover:border-white/40
                   hover:bg-white/10
                   hover:text-white">

            <span class="text-sm">←</span>
            <span>Volver</span>

        </a>


        {{-- ========================================================
             TARJETA CENTRAL
        ======================================================== --}}

        <main class="flex min-h-screen items-center justify-center px-5 py-20">

            <div
                class="w-full max-w-[295px]
                       overflow-hidden
                       rounded-[22px]
                       bg-[#f8f7f5]
                       px-7 py-8
                       shadow-[0_25px_70px_rgba(0,0,0,0.40)]
                       sm:max-w-[310px]">

                {{-- ==================================================
                     LOGO
                ================================================== --}}

                <div class="flex flex-col items-center">

                    <img
                        src="{{ asset('images/tincho.png') }}"
                        alt="Mueblería Tincho"
                        class="h-[58px] w-auto object-contain">

                    {{-- Nombre --}}
                    <h1
                        class="mt-1 text-center
                               font-['DM_Serif_Display']
                               text-[20px]
                               leading-tight
                               text-[#25211e]">

                        Mueblería
                        <span class="text-[#b07d3a] italic">
                            Tincho
                        </span>

                    </h1>

                    {{-- Ubicación --}}
                    <p class="mt-1 text-center text-[10px] font-medium text-gray-500">
                        Chasquipampa · La Paz, Bolivia
                    </p>

                </div>


                {{-- Línea divisoria --}}
                <div class="my-6 h-px w-full bg-[#e5e0da]"></div>


                {{-- ==================================================
                     CONTENIDO BREEZE
                ================================================== --}}

                <div class="text-sm">

                    {{ $slot }}

                </div>

            </div>

        </main>


        {{-- ========================================================
             MARCA INFERIOR IZQUIERDA
        ======================================================== --}}

        <div
            class="absolute bottom-5 left-8 hidden max-w-[230px] text-white sm:block">

            <h2
                class="font-['DM_Serif_Display']
                       text-[17px]
                       leading-tight
                       text-white">

                Mueblería
                <span class="text-[#c18a43] italic">
                    Tincho
                </span>

            </h2>

            <p class="mt-3 text-[10px] font-semibold leading-[1.7] text-white/45">
                Muebles de melamina a medida.<br>
                Calidad y diseño en La Paz,<br>
                Bolivia.
            </p>

        </div>


    </div>

</body>

</html>