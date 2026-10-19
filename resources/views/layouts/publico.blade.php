
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Mueblería Tincho')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Iconos Phosphor --}}
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js"></script>

    @stack('styles')
</head>

<body class="bg-stone-50 text-stone-800 antialiased">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 border-b border-stone-200 bg-white/95 shadow-sm backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex min-h-20 items-center justify-between gap-4">

                {{-- LOGO --}}
                <a
                    href="{{ route('home') }}#inicio"
                    class="flex shrink-0 items-center gap-3"
                    aria-label="Mueblería Tincho, ir al inicio"
                >
                    <img
                        src="{{ asset('images/tincho.png') }}"
                        alt="Logo de Mueblería Tincho"
                        class="h-12 w-12 object-contain sm:h-14 sm:w-14"
                    >

                    <div class="leading-tight">
                        <h1 class="font-['DM_Serif_Display'] text-lg font-bold text-stone-900 sm:text-xl">
                            Mueblería
                            <span class="text-[#B07D3A]">Tincho</span>
                        </h1>

                        <p class="mt-1 text-xs text-stone-500">
                            La Paz - Bolivia
                        </p>
                    </div>
                </a>

                {{-- NAVEGACIÓN DESKTOP --}}
                <nav
                    class="hidden items-center gap-6 lg:flex xl:gap-8"
                    aria-label="Navegación principal"
                >
                    <a
                        href="{{ route('home') }}#inicio"
                        class="rounded-md py-2 text-sm font-semibold text-stone-600 transition hover:text-[#B07D3A]"
                    >
                        Inicio
                    </a>

                    <a
                        href="{{ route('home') }}#nosotros"
                        class="rounded-md py-2 text-sm font-semibold text-stone-600 transition hover:text-[#B07D3A]"
                    >
                        Nosotros
                    </a>

                    <a
                        href="{{ route('catalogo') }}"
                        class="rounded-md py-2 text-sm font-semibold text-stone-600 transition hover:text-[#B07D3A]"
                    >
                        Catálogo
                    </a>

                    <a
                        href="{{ route('contacto') }}"
                        class="rounded-md py-2 text-sm font-semibold text-stone-600 transition hover:text-[#B07D3A]"
                    >
                        Contacto
                    </a>

                    <a
                        href="{{ route('compra.carrito') }}"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 transition hover:text-amber-700"
                    >
                        <i data-phosphor-icon="shopping-cart"></i>
                        Mi solicitud
                    </a>
                </nav>

                {{-- AUTENTICACIÓN DESKTOP --}}
                <div class="hidden items-center gap-3 lg:flex">

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 transition hover:border-[#B07D3A] hover:bg-amber-50 hover:text-[#B07D3A]"
                        >
                            <ph-sign-in class="text-lg"></ph-sign-in>
                            Ingresar
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-[#B07D3A] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#8A5E22] hover:shadow-md"
                        >
                            <ph-user-plus weight="bold" class="text-lg"></ph-user-plus>
                            Registrarse
                        </a>
                    @else
                        {{-- PERFIL DEL USUARIO --}}
                        <a
                            href="{{ route('dashboard') }}"
                            aria-label="Ir al panel de {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}"
                            class="group inline-flex max-w-56 items-center gap-2.5 rounded-xl border border-stone-200 bg-white px-3 py-2 transition hover:border-[#B07D3A] hover:bg-amber-50"
                        >
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-[#B07D3A] transition group-hover:bg-[#B07D3A] group-hover:text-white">
                                <ph-user-circle weight="fill" class="text-2xl"></ph-user-circle>
                            </span>

                            <span class="max-w-36 truncate text-sm font-semibold text-stone-700">
                                {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}
                            </span>
                        </a>

                        {{-- CERRAR SESIÓN --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-500 transition hover:bg-red-50 hover:text-red-700"
                            >
                                <ph-sign-out class="text-lg"></ph-sign-out>
                                Salir
                            </button>
                        </form>
                    @endguest

                </div>

                {{-- BOTÓN HAMBURGUESA --}}
                <button
                    id="boton-menu-movil"
                    type="button"
                    class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-stone-200 bg-white text-stone-700 transition hover:border-[#B07D3A] hover:bg-amber-50 hover:text-[#B07D3A] lg:hidden"
                    aria-label="Abrir menú de navegación"
                    aria-controls="menu-movil"
                    aria-expanded="false"
                >
                    <ph-list id="icono-menu-abrir" class="text-2xl"></ph-list>
                    <ph-x id="icono-menu-cerrar" class="hidden text-2xl"></ph-x>
                </button>

            </div>
        </div>

        {{-- MENÚ RESPONSIVO MÓVIL --}}
        <div
            id="menu-movil"
            class="hidden border-t border-stone-200 bg-white lg:hidden"
        >
            <nav
                class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-4 sm:px-6"
                aria-label="Navegación móvil"
            >
                {{-- ENLACES DE NAVEGACIÓN --}}
                <a
                    href="{{ route('home') }}#inicio"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]"
                >
                    <ph-house class="text-xl"></ph-house>
                    Inicio
                </a>

                <a
                    href="{{ route('home') }}#nosotros"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]"
                >
                    <ph-buildings class="text-xl"></ph-buildings>
                    Nosotros
                </a>

                <a
                    href="{{ route('catalogo') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]"
                >
                    <ph-armchair class="text-xl"></ph-armchair>
                    Catálogo
                </a>

                <a
                    href="{{ route('contacto') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]"
                >
                    <ph-envelope-simple class="text-xl"></ph-envelope-simple>
                    Contacto
                </a>

                <!-- ver -->
                 <a
                    href="{{ route('compra.carrito') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 transition hover:text-amber-700"
                >
                    <i data-phosphor-icon="shopping-cart"></i>
                    Mi solicitud
                </a>

                {{-- SEPARADOR --}}
                <div class="my-3 border-t border-stone-200"></div>

                {{-- ACCIONES DEL USUARIO --}}
                @guest
               <a href="{{ route('login') }}" 
               class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]" >
                 <ph-sign-in class="text-xl">
                 </ph-sign-in>
                  Ingresar 
                </a>
                 {{-- CREAR CUENTA --}} 
                 <a href="{{ route('register') }}"
                  class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-stone-600 transition hover:bg-stone-100 hover:text-[#B07D3A]" > 
                  <ph-user-plus weight="bold" class="text-xl">

                  </ph-user-plus> 
                  Crear una cuenta 
                </a>
                @else
                    {{-- PERFIL DEL USUARIO --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="my-1 flex items-center gap-3 rounded-xl border border-stone-200 bg-stone-50 p-3 transition hover:border-[#B07D3A] hover:bg-amber-50"
                    >
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-[#B07D3A]">
                            <ph-user-circle weight="fill" class="text-3xl"></ph-user-circle>
                        </span>

                        <span class="min-w-0 flex-1">
                            <span class="block text-xs text-stone-500">
                                Mi perfil
                            </span>

                            <span class="block truncate font-semibold text-stone-800">
                                {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}
                            </span>

                            <span class="mt-1 block text-xs text-[#B07D3A]">
                                Ir a mi panel
                            </span>
                        </span>

                        <ph-caret-right class="text-xl text-stone-400"></ph-caret-right>
                    </a>

              
                @endguest

            </nav>
        </div>
    </header>

    {{-- CONTENIDO DE CADA PÁGINA --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-stone-950 pt-16 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid gap-12 border-b border-white/10 pb-12 md:grid-cols-3">

                {{-- MARCA --}}
                <div>
                    <div class="flex items-center gap-3">
                        <img
                            src="{{ asset('images/tincho.png') }}"
                            alt="Logo Mueblería Tincho"
                            class="h-10 w-10 object-contain"
                        >

                        <span class="font-['DM_Serif_Display'] text-xl">
                            Mueblería
                            <em class="text-[#D4A860]">Tincho</em>
                        </span>
                    </div>

                    <p class="mt-5 max-w-sm text-sm leading-7 text-white/40">
                        Fabricamos muebles de melamina a medida con calidad y diseño
                        moderno para hogares y oficinas en La Paz, Bolivia.
                    </p>

                    {{-- REDES SOCIALES --}}
                    <div class="mt-6 flex gap-3">
                        <a
                            href="#"
                            aria-label="Facebook"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >
                            <ph-facebook-logo weight="fill" class="text-xl"></ph-facebook-logo>
                        </a>

                        <a
                            href="#"
                            aria-label="Instagram"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >
                            <ph-instagram-logo weight="fill" class="text-xl"></ph-instagram-logo>
                        </a>

                        <a
                            href="#"
                            aria-label="TikTok"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >
                            <ph-tiktok-logo weight="fill" class="text-xl"></ph-tiktok-logo>
                        </a>
                    </div>
                </div>

                {{-- NAVEGACIÓN --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.15em] text-white/30">
                        Navegación
                    </h3>

                    <ul class="mt-5 space-y-4">
                        <li>
                            <a
                                href="{{ route('home') }}#inicio"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Inicio
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('home') }}#nosotros"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Nosotros
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('catalogo') }}"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Catálogo
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('contacto') }}"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- CONTACTO --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.15em] text-white/30">
                        Dónde estamos
                    </h3>

                    <div class="mt-5 space-y-5">

                        <div class="flex gap-3">
                            <ph-map-pin
                                weight="fill"
                                class="mt-1 shrink-0 text-lg text-[#B07D3A]"
                            ></ph-map-pin>

                            <div class="text-sm leading-6 text-white/50">
                                <strong class="block text-xs uppercase tracking-wider text-white/30">
                                    Dirección
                                </strong>

                                Calle 48 - Chasquipampa, Zona Sur
                                <br>
                                La Paz, Bolivia
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <ph-phone
                                weight="fill"
                                class="mt-1 shrink-0 text-lg text-[#B07D3A]"
                            ></ph-phone>

                            <div class="text-sm text-white/50">
                                <strong class="block text-xs uppercase tracking-wider text-white/30">
                                    Teléfono
                                </strong>

                                +591 0000000
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <ph-envelope-simple
                                weight="fill"
                                class="mt-1 shrink-0 text-lg text-[#B07D3A]"
                            ></ph-envelope-simple>

                            <div class="text-sm text-white/50">
                                <strong class="block text-xs uppercase tracking-wider text-white/30">
                                    Correo
                                </strong>

                                muebleriatincho@gmail.com
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <ph-clock
                                weight="fill"
                                class="mt-1 shrink-0 text-lg text-[#B07D3A]"
                            ></ph-clock>

                            <div class="text-sm leading-6 text-white/50">
                                <strong class="block text-xs uppercase tracking-wider text-white/30">
                                    Horario
                                </strong>

                                Lun a Vie: 08:00 – 17:30
                                <br>
                                Sáb: 10:00 – 15:00
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- COPYRIGHT --}}
            <div class="flex flex-col items-center justify-between gap-3 py-6 text-center sm:flex-row sm:text-left">
                <p class="text-xs text-white/25">
                    © {{ date('Y') }} Mueblería Tincho.
                    Todos los derechos reservados.
                </p>

                <p class="text-xs text-white/25">
                    La Paz, Bolivia
                </p>
            </div>

        </div>
    </footer>

    {{-- JAVASCRIPT DEL MENÚ MÓVIL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botonMenu = document.getElementById('boton-menu-movil');
            const menuMovil = document.getElementById('menu-movil');
            const iconoAbrir = document.getElementById('icono-menu-abrir');
            const iconoCerrar = document.getElementById('icono-menu-cerrar');

            if (!botonMenu || !menuMovil) {
                return;
            }

            function cerrarMenu() {
                menuMovil.classList.add('hidden');
                botonMenu.setAttribute('aria-expanded', 'false');
                botonMenu.setAttribute('aria-label', 'Abrir menú de navegación');

                if (iconoAbrir && iconoCerrar) {
                    iconoAbrir.classList.remove('hidden');
                    iconoCerrar.classList.add('hidden');
                }
            }

            botonMenu.addEventListener('click', function () {
                const debeAbrirse = menuMovil.classList.contains('hidden');

                menuMovil.classList.toggle('hidden', !debeAbrirse);
                botonMenu.setAttribute('aria-expanded', String(debeAbrirse));
                botonMenu.setAttribute(
                    'aria-label',
                    debeAbrirse ? 'Cerrar menú de navegación' : 'Abrir menú de navegación'
                );

                if (iconoAbrir && iconoCerrar) {
                    iconoAbrir.classList.toggle('hidden', debeAbrirse);
                    iconoCerrar.classList.toggle('hidden', !debeAbrirse);
                }
            });

            // Cerrar el menú al seleccionar una opción.
            menuMovil.querySelectorAll('a').forEach(function (enlace) {
                enlace.addEventListener('click', cerrarMenu);
            });

            document.addEventListener('keydown', function (evento) {
                if (evento.key === 'Escape') {
                    cerrarMenu();
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    cerrarMenu();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
