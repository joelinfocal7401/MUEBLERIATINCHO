<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Mueblería Tincho | Muebles de Melamina a Medida en La Paz
    </title>

    <meta
        name="description"
        content="Mueblería Tincho en La Paz, Bolivia. Fabricamos muebles de melamina a medida con diseños modernos, calidad y precios accesibles."
    >

    <meta
        name="keywords"
        content="mueblería Tincho, muebles de melamina, muebles a medida, muebles La Paz, muebles Bolivia, Chasquipampa"
    >

    <meta name="author" content="Mueblería Tincho">

    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Mueblería Tincho | Muebles a Medida">

    <meta
        property="og:description"
        content="Muebles de melamina a medida para hogares y oficinas en La Paz, Bolivia."
    >

    <meta property="og:type" content="website">

    <link rel="canonical" href="{{ url('/') }}">

    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- Tailwind / Vite --}}
    @vite(['resources/css/app.css'])
    
</head>


<body class="bg-stone-50 text-stone-900 antialiased">

    {{-- WHATSAPP --}}

    <a
        href="https://wa.me/59170000000?text=Hola%20Mueblería%20Tincho,%20quiero%20consultar."
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Contactar con Mueblería Tincho por WhatsApp"
        class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-xl transition duration-300 hover:scale-110 hover:bg-green-600"
    >
        <ph-whatsapp-logo
            weight="fill"
            class="text-3xl"
        ></ph-whatsapp-logo>
    </a>


    {{-- NAVBAR --}}

    <nav
        id="mainNav"
        class="sticky top-0 z-40 border-b border-stone-200 bg-stone-50/95 backdrop-blur-xl"
    >

        <div class="mx-auto flex h-[70px] max-w-7xl items-center justify-between px-6 lg:px-8">

            {{-- LOGO --}}
            <a
                href="#inicio"
                class="flex shrink-0 items-center gap-3"
                aria-label="Mueblería Tincho - Inicio"
            >

                <img
                    src="{{ asset('images/tincho.png') }}"
                    alt="Logo Mueblería Tincho"
                    class="h-11 w-11 object-contain"
                >

                <div class="flex flex-col leading-tight">

                    <span
                        class="font-['DM_Serif_Display'] text-lg text-stone-900"
                    >
                        Mueblería
                        <em class="text-[#B07D3A]">Tincho</em>
                    </span>

                    <span
                        class="text-[10px] font-semibold uppercase tracking-[0.15em] text-stone-500"
                    >
                        La Paz, Bolivia
                    </span>

                </div>

            </a>


            {{-- NAVEGACIÓN DESKTOP --}}
            <div class="hidden items-center gap-1 lg:flex">

                <a
                    href="#inicio"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-stone-700 transition hover:text-[#B07D3A]"
                >
                    Inicio
                </a>

                <a
                    href="#nosotros"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-stone-700 transition hover:text-[#B07D3A]"
                >
                    Nosotros
                </a>

                <a
                    href="#catalogo"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-stone-700 transition hover:text-[#B07D3A]"
                >
                    Catálogo
                </a>

            </div>


            {{-- AUTENTICACIÓN --}}
            <div class="hidden items-center gap-3 lg:flex">

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 transition hover:border-[#B07D3A] hover:text-[#B07D3A]"
                    >
                        <ph-sign-in class="text-lg"></ph-sign-in>
                        Ingresar
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#B07D3A] px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-[#8A5E22]"
                    >
                        <ph-user-plus weight="bold" class="text-lg"></ph-user-plus>
                        Registrarse
                    </a>
                @else
                    {{-- PERFIL --}}
                    <a
                        href="{{ route('dashboard') }}"
                        aria-label="Ir al perfil de {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}"
                        class="group inline-flex max-w-56 items-center gap-2.5 rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-sm font-semibold text-stone-700 shadow-sm transition hover:border-[#B07D3A] hover:bg-amber-50"
                    >
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-[#B07D3A] transition group-hover:bg-[#B07D3A] group-hover:text-white">
                            <ph-user-circle weight="fill" class="text-2xl"></ph-user-circle>
                        </span>

                        <span class="truncate">
                            {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}
                        </span>
                    </a>

                    </form>
                @endguest

            </div>


            {{-- MENÚ MÓVIL --}}
            <button
            id="mobileMenuButton"
            type="button"
            aria-label="Abrir menú"
            aria-expanded="false"
            class="flex h-11 w-11 shrink-0 flex-col items-center justify-center gap-[6px] rounded-lg border border-stone-140 bg-white shadow-sm transition hover:bg-stone-100 lg:hidden"
            >
                <span class="block h-[3px] w-7 rounded-full bg-stone-500"></span>
                <span class="block h-[3px] w-7 rounded-full bg-stone-500"></span>
                <span class="block h-[3px] w-7 rounded-full bg-stone-500"></span>
            </button>

        </div>


        {{-- MENÚ MÓVIL --}}
        <div
            id="mobileMenu"
            class="hidden border-t border-stone-200 bg-stone-50 px-6 py-5 lg:hidden"
        >

            <div class="flex flex-col">

                <a
                    href="#inicio"
                    class="border-b border-stone-200 py-4 text-base font-semibold text-stone-800"
                >
                    Inicio
                </a>

                <a
                    href="#nosotros"
                    class="border-b border-stone-200 py-4 text-base font-semibold text-stone-800"
                >
                    Nosotros
                </a>

                <a
                    href="#catalogo"
                    class="border-b border-stone-200 py-4 text-base font-semibold text-stone-800"
                >
                    Catálogo
                </a>

                @guest

                    <a
                        href="{{ route('login') }}"
                        class="border-b border-stone-200 py-4 font-semibold text-stone-700 transition hover:text-[#B07D3A]"
                    >
                        <span class="inline-flex items-center gap-3">
                            <ph-sign-in class="text-xl"></ph-sign-in>
                            Ingresar
                        </span>
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="py-4 font-semibold text-[#B07D3A]"
                    >
                        <span class="inline-flex items-center gap-3">
                            <ph-user-plus weight="bold" class="text-xl"></ph-user-plus>
                            Registrarse
                        </span>
                    </a>

                @else

                    {{-- PERFIL MÓVIL --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="my-3 flex items-center gap-3 rounded-2xl border border-stone-200 bg-white p-4 shadow-sm transition hover:border-[#B07D3A]"
                    >
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-[#B07D3A]">
                            <ph-user-circle weight="fill" class="text-3xl"></ph-user-circle>
                        </span>

                        <span class="min-w-0 flex-1">
                            <span class="block text-xs font-medium text-stone-500">
                                Mi perfil
                            </span>

                            <span class="block truncate font-semibold text-stone-900">
                                {{ auth()->user()->nombre ?? auth()->user()->name ?? auth()->user()->email }}
                            </span>

                            <span class="mt-1 block text-xs text-[#B07D3A]">
                                Ir a mi panel
                            </span>
                        </span>

                        <ph-caret-right class="shrink-0 text-xl text-stone-400"></ph-caret-right>
                    </a>

                @endguest

            </div>

        </div>

    </nav>


    <main>
        {{-- HERO --}}

        <section
            id="inicio"
            class="relative flex min-h-[88vh] items-center overflow-hidden"
        >

            <div
                class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ asset('images/fondo1.jpg') }}');"
            ></div>


            <div
                class="absolute inset-0 bg-gradient-to-r from-stone-950/90 via-stone-950/70 to-stone-950/30"
            ></div>


            <div class="relative z-10 mx-auto w-full max-w-7xl px-6 py-24 lg:px-8">

                <div class="max-w-3xl">

                    <div class="mb-6 flex items-center gap-3">

                        <span class="h-2 w-2 rounded-full bg-[#D4A860]"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4A860]">
                            Elaboración artesanal
                        </span>

                    </div>


                    <h1
                        class="font-['DM_Serif_Display'] text-5xl leading-[1.05] tracking-tight text-white sm:text-6xl lg:text-7xl"
                    >
                        Muebles que transforman
                        tu
                        <em class="text-[#D4A860]">espacio</em>
                    </h1>


                    <p class="mt-7 max-w-xl text-base leading-8 text-white/70 sm:text-lg">
                        Elaboramos muebles en base a melamina a medida para hogares
                        en La Paz, ofreciendo diseño, calidad y precios accesibles.
                    </p>


                    <div class="mt-9 flex flex-wrap gap-4">

                        <a
                            href="#catalogo"
                            class="inline-flex items-center gap-2 rounded-full bg-[#B07D3A] px-7 py-4 text-sm font-bold text-white shadow-lg transition hover:-translate-y-1 hover:bg-[#8A5E22]"
                        >

                            <ph-squares-four weight="bold"></ph-squares-four>

                            Ver catálogo

                        </a>

                        <a
                            href="#nosotros"
                            class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-4 text-sm font-bold text-white transition hover:border-white hover:bg-white/10"
                        >

                            <ph-info></ph-info>

                            Conocernos

                        </a>

                    </div>


                    <div class="mt-14 flex flex-wrap gap-8 sm:gap-10">

                        <div>

                            <div class="font-['DM_Serif_Display'] text-3xl text-white">
                                7+
                            </div>

                            <div class="mt-1 text-xs uppercase tracking-wider text-white/45">
                                Años de experiencia
                            </div>

                        </div>


                        <div class="hidden h-12 w-px bg-white/15 sm:block"></div>


                        <div>

                            <div class="font-['DM_Serif_Display'] text-3xl text-white">
                                70+
                            </div>

                            <div class="mt-1 text-xs uppercase tracking-wider text-white/45">
                                Muebles entregados
                            </div>

                        </div>


                        <div class="hidden h-12 w-px bg-white/15 sm:block"></div>


                        <div>

                            <div class="font-['DM_Serif_Display'] text-3xl text-white">
                                100%
                            </div>

                            <div class="mt-1 text-xs uppercase tracking-wider text-white/45">
                                A medida
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- NOSOTROS --}}

        <section
            id="nosotros"
            class="bg-white py-24"
        >

            <div class="mx-auto max-w-7xl px-6 lg:px-8">

                <div class="mx-auto mb-14 max-w-2xl text-center">

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#B07D3A]">
                        Quiénes somos
                    </span>

                    <h2
                        class="mt-3 font-['DM_Serif_Display'] text-4xl tracking-tight text-stone-900 sm:text-5xl"
                    >
                        Una mueblería con
                        <em class="text-[#B07D3A]">propósito</em>
                    </h2>

                    <p class="mt-5 leading-7 text-stone-500">
                        El diseño, la calidad y el compromiso con nuestros clientes
                        son nuestra prioridad.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- MISIÓN --}}
                    <article
                        class="group relative overflow-hidden rounded-[28px] border border-stone-200 bg-stone-50 p-8 transition duration-300 hover:-translate-y-2 hover:border-[#B07D3A]/30 hover:shadow-2xl"
                    >

                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-[#B07D3A] text-2xl text-white shadow-lg"
                        >

                            <ph-target weight="fill"></ph-target>

                        </div>

                        <h3
                            class="font-['DM_Serif_Display'] text-2xl text-stone-900"
                        >
                            Misión
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-stone-500">
                            Brindar muebles a medida en base a melamina que satisfagan
                            las necesidades de los clientes, ofreciendo productos de
                            calidad y a precios accesibles, mediante el compromiso de
                            un trabajo responsable en la atención y satisfacción de
                            cada cliente.
                        </p>

                    </article>


                    {{-- VISIÓN --}}
                    <article
                        class="group relative overflow-hidden rounded-[28px] border border-stone-200 bg-stone-50 p-8 transition duration-300 hover:-translate-y-2 hover:border-[#B07D3A]/30 hover:shadow-2xl"
                    >

                        <div
                            class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-[#B07D3A] text-2xl text-white shadow-lg"
                        >

                            <ph-binoculars weight="fill"></ph-binoculars>

                        </div>

                        <h3
                            class="font-['DM_Serif_Display'] text-2xl text-stone-900"
                        >
                            Visión
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-stone-500">
                            Ser la mueblería reconocida en La Paz por la calidad y
                            diseño de muebles a medida a precios accesibles,
                            impulsando nuestra eficiencia mediante la transformación
                            digital y la mejora continua.
                        </p>

                    </article>

                </div>


                <div
                    class="mt-6 grid overflow-hidden rounded-[28px] border border-stone-200 bg-stone-50 md:grid-cols-3"
                >

                    <div class="flex gap-4 border-b border-stone-200 p-7 md:border-b-0 md:border-r">

                        <ph-medal
                            weight="fill"
                            class="shrink-0 text-2xl text-[#B07D3A]"
                        ></ph-medal>

                        <div>

                            <h3 class="font-semibold text-stone-900">
                                Diseños personalizados
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-stone-500">
                                Fabricamos muebles adaptados exactamente a tu espacio
                                y presupuesto.
                            </p>

                        </div>

                    </div>


                    <div class="flex gap-4 border-b border-stone-200 p-7 md:border-b-0 md:border-r">

                        <ph-shield-check
                            weight="fill"
                            class="shrink-0 text-2xl text-[#B07D3A]"
                        ></ph-shield-check>

                        <div>

                            <h3 class="font-semibold text-stone-900">
                                Materiales de calidad
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-stone-500">
                                Melamina resistente y duradera con acabados de primer nivel.
                            </p>

                        </div>

                    </div>


                    <div class="flex gap-4 p-7">

                        <ph-handshake
                            weight="fill"
                            class="shrink-0 text-2xl text-[#B07D3A]"
                        ></ph-handshake>

                        <div>

                            <h3 class="font-semibold text-stone-900">
                                Atención garantizada
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-stone-500">
                                Te acompañamos desde el diseño hasta la entrega e instalación.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- CATÁLOGO --}}

        <section
            id="catalogo"
            class="bg-stone-100 py-24"
        >

            <div class="mx-auto max-w-7xl px-6 lg:px-8">

                <div class="mb-12">

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#B07D3A]">
                        Nuestros trabajos
                    </span>

                    <h2
                        class="mt-3 font-['DM_Serif_Display'] text-4xl tracking-tight text-stone-900 sm:text-5xl"
                    >
                        Catálogo de
                        <em class="text-[#B07D3A]">muebles</em>
                    </h2>

                    <p class="mt-4 max-w-xl text-sm leading-7 text-stone-500">
                        Conoce algunos de nuestros muebles fabricados en melamina
                        y encuentra el diseño ideal para tu espacio.
                    </p>

                </div>


                {{-- GRID DE MUEBLES --}}
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @forelse($muebles as $mueble)

                        <article
                            class="group flex flex-col overflow-hidden rounded-[28px] bg-white shadow-sm transition duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        >

                            {{-- Imagen --}}
                            <div class="relative h-64 overflow-hidden bg-stone-100">

                                {{-- CORREGIDO: imagen --}}
                                @if($mueble->imagen)

                                    <img
                                        src="{{ asset('storage/' . $mueble->imagen) }}"
                                        alt="{{ $mueble->nombre }} - Mueblería Tincho"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-full w-full items-center justify-center bg-stone-100">

                                        <ph-image
                                            class="text-6xl text-stone-300"
                                        ></ph-image>

                                    </div>

                                @endif


                                {{-- Categoría --}}                        
                                @if($mueble->categoria)
                                    <span
                                        class="absolute left-4 top-4 rounded-full
                                            bg-stone-950/75 px-3 py-1.5
                                            text-[10px] font-bold uppercase
                                            tracking-wider text-white backdrop-blur-md"
                                    >
                                        {{ $mueble->categoria->nombre }}
                                    </span>
                                @endif

                            </div>


                            {{-- Información --}}
                            <div class="flex flex-1 flex-col p-6">

                                <h3
                                    class="font-['DM_Serif_Display'] text-xl text-stone-900"
                                >
                                    {{ $mueble->nombre }}
                                </h3>


                                <p class="mt-2 flex-1 text-sm leading-6 text-stone-500">

                                    {{ Str::limit($mueble->descripcion, 90) }}

                                </p>


                                {{-- Precio / estado --}}
                                <div class="mt-5 flex items-end justify-between gap-4">

                                    <div>

                                        <span class="block text-[10px] font-medium uppercase tracking-wider text-stone-400">
                                            Desde
                                        </span>

                                        {{-- CORREGIDO: precio --}}
                                        <span
                                            class="font-['DM_Serif_Display'] text-2xl text-[#B07D3A]"
                                        >
                                            Bs.
                                            {{ number_format((float) $mueble->precio, 2) }}
                                        </span>

                                    </div>


                                    {{-- CORREGIDO: estado booleano --}}
                                    @if($mueble->estado)

                                        <span
                                            class="rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700"
                                        >
                                            Disponible
                                        </span>

                                    @else

                                        <span
                                            class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700"
                                        >
                                            No disponible
                                        </span>

                                    @endif

                                </div>


                                {{-- Botón --}}
                                <a
                                    href="{{ route('muebles.detalle', $mueble->_id) }}"
                                    class="mt-5 flex items-center justify-center gap-2 rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#B07D3A]"
                                >

                                    Ver detalles

                                    <ph-arrow-right
                                        weight="bold"
                                    ></ph-arrow-right>

                                </a>

                            </div>

                        </article>

                    @empty

                        {{-- CATÁLOGO VACÍO --}}
                        <div
                            class="col-span-full rounded-[28px] border border-dashed border-stone-300 bg-white px-6 py-16 text-center"
                        >

                            <ph-package
                                class="mx-auto text-6xl text-stone-300"
                            ></ph-package>

                            <h3
                                class="mt-5 font-['DM_Serif_Display'] text-2xl text-stone-800"
                            >
                                Próximamente
                            </h3>

                            <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-stone-500">
                                Estamos preparando nuestro catálogo completo de muebles.
                            </p>

                            <a
                                href="https://wa.me/59170000000"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-6 inline-flex items-center gap-2 font-semibold text-[#B07D3A] hover:text-[#8A5E22]"
                            >

                                <ph-whatsapp-logo weight="fill"></ph-whatsapp-logo>

                                Consultarnos por WhatsApp

                            </a>

                        </div>

                    @endforelse
               
                </div>
                     <div class="mt-5 flex justify-center">
                        <a href="{{ route('catalogo') }}"
                        class="inline-flex items-center gap-2 rounded-xl  bg-[#B07D3A]
                                px-7 py-3 font-semibold text-white hover:bg-[#8A5E22] hover:shadow-lg transition">
                            Ver todos los muebles
                            <i data-lucide="arrow-right" class="h-5 w-5"></i>
                        </a>
                    </div>
            </div>

        </section>

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

                            <em class="text-[#D4A860]">
                                Tincho
                            </em>

                        </span>

                    </div>


                    <p class="mt-5 max-w-sm text-sm leading-7 text-white/40">
                        Fabricamos muebles de melamina a medida con calidad y diseño
                        moderno para hogares y oficinas en La Paz, Bolivia.
                    </p>


                    {{-- Redes --}}
                    <div class="mt-6 flex gap-3">

                        <a
                            href="#"
                            aria-label="Facebook"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >

                            <ph-facebook-logo
                                weight="fill"
                                class="text-xl"
                            ></ph-facebook-logo>

                        </a>


                        <a
                            href="#"
                            aria-label="Instagram"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >

                            <ph-instagram-logo
                                weight="fill"
                                class="text-xl"
                            ></ph-instagram-logo>

                        </a>


                        <a
                            href="#"
                            aria-label="TikTok"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/50 transition hover:bg-[#B07D3A] hover:text-white"
                        >

                            <ph-tiktok-logo
                                weight="fill"
                                class="text-xl"
                            ></ph-tiktok-logo>

                        </a>

                    </div>

                </div>


                {{-- NAVEGACIÓN --}}
                <div>

                    <h3
                        class="text-xs font-bold uppercase tracking-[0.15em] text-white/30"
                    >
                        Navegación
                    </h3>

                    <ul class="mt-5 space-y-4">

                        <li>
                            <a
                                href="#inicio"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Inicio
                            </a>
                        </li>

                        <li>
                            <a
                                href="#nosotros"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Nosotros
                            </a>
                        </li>

                        <li>
                            <a
                                href="#catalogo"
                                class="text-sm text-white/50 transition hover:text-[#D4A860]"
                            >
                                Catálogo
                            </a>
                        </li>

                    </ul>

                </div>

                {{-- CONTACTO --}}
                <div>

                    <h3
                        class="text-xs font-bold uppercase tracking-[0.15em] text-white/30"
                    >
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

    {{-- JAVASCRIPT --}}
    <script>

        /* MENÚ MÓVIL*/

        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuButton && mobileMenu) {

            mobileMenuButton.addEventListener('click', function () {

                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {

                    mobileMenu.classList.remove('hidden');

                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                } else {

                    mobileMenu.classList.add('hidden');

                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            });


            const mobileLinks = mobileMenu.querySelectorAll('a');

            mobileLinks.forEach(function (link) {

                link.addEventListener('click', function () {

                    mobileMenu.classList.add('hidden');

                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                });

            });

        }


        /*  | NAVBAR AL HACER SCROLL */

        const mainNav = document.getElementById('mainNav');

        if (mainNav) {

            window.addEventListener(
                'scroll',
                function () {

                    if (window.scrollY > 20) {

                        mainNav.classList.add(
                            'shadow-[0_4px_30px_rgba(20,18,16,0.08)]'
                        );

                    } else {

                        mainNav.classList.remove(
                            'shadow-[0_4px_30px_rgba(20,18,16,0.08)]'
                        );

                    }

                },
                {
                    passive: true
                }
            );

        }
        /*  SMOOTH SCROLL */

        document.querySelectorAll('a[href^="#"]').forEach(function (link) {

            link.addEventListener('click', function (event) {

                const targetId = this.getAttribute('href');

                if (
                    targetId &&
                    targetId !== '#'
                ) {

                    const target = document.querySelector(targetId);

                    if (target) {

                        event.preventDefault();

                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    }

                }

            });

        });

    </script>

</body>
</html>