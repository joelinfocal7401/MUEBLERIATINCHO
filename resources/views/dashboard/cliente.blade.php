
@extends('layouts.cliente')

@section('title', 'Mi dashboard')

@section('content')

<div class="mx-auto max-w-7xl space-y-8">

    {{-- Encabezado --}}
    <section class="relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white sm:p-8">
        <div class="relative z-10 max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-400">
                Mueblería Tincho
            </p>

            <h1 class="mt-3 text-3xl font-bold sm:text-4xl">
                ¡Hola, {{ auth()->user()->name ?? 'Cliente' }}!
            </h1>

            <p class="mt-3 leading-6 text-slate-300">
                Bienvenido a tu espacio personal. Consulta tus solicitudes,
                revisa tus cotizaciones y descubre nuestros muebles.
            </p>

            <a href="{{ route('catalogo') }}"
               class="mt-6 inline-flex items-center gap-2 rounded-lg bg-amber-400 px-5 py-3 font-semibold text-slate-900 transition hover:bg-amber-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2">
                    <path d="M3 3h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 8H6"/>
                    <circle cx="10" cy="20" r="1"/>
                    <circle cx="18" cy="20" r="1"/>
                </svg>
                Explorar catálogo
            </a>
        </div>

        <div class="pointer-events-none absolute -right-10 -top-10 hidden h-64 w-64 rounded-full border-[30px] border-white/5 sm:block"></div>
        <div class="pointer-events-none absolute -bottom-20 right-20 hidden h-52 w-52 rounded-full bg-amber-400/10 sm:block"></div>
    </section>

    {{-- Accesos principales --}}
    <section>
        <div class="mb-4">
            <h2 class="text-xl font-bold text-gray-900">
                Accesos rápidos
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                ¿Qué deseas hacer hoy?
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

            {{-- Mis pedidos --}}
            <a href="{{ route('cliente.mis-pedidos') }}"
               class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-amber-300 hover:shadow-md">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.8">
                        <path d="M6 3h12a2 2 0 0 1 2 2v16l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z"/>
                        <path d="M9 8h6M9 12h6"/>
                    </svg>
                </div>

                <h3 class="mt-5 font-bold text-gray-900">Mis pedidos y cotizaciones</h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Revisa tus solicitudes, precios cotizados y estados.
                </p>

                <span class="mt-4 inline-block text-sm font-semibold text-amber-700 group-hover:text-amber-800">
                    Consultar pedidos →
                </span>
            </a>

            {{-- Catálogo --}}
            <a href="{{ route('catalogo') }}"
               class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-amber-300 hover:shadow-md">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.8">
                        <path d="M3 10V5a2 2 0 0 1 2-2h5v7H3ZM14 3h5a2 2 0 0 1 2 2v5h-7V3ZM3 14h7v7H5a2 2 0 0 1-2-2v-5ZM14 14h7v5a2 2 0 0 1-2 2h-5v-7Z"/>
                    </svg>
                </div>

                <h3 class="mt-5 font-bold text-gray-900">Catálogo de muebles</h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Explora los muebles disponibles y agrega productos al carrito.
                </p>

                <span class="mt-4 inline-block text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                    Ver catálogo →
                </span>
            </a>

            {{-- Perfil --}}
            <a href="{{ route('cliente.perfil') }}"
               class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-amber-300 hover:shadow-md">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.8">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21a8 8 0 0 1 16 0"/>
                    </svg>
                </div>

                <h3 class="mt-5 font-bold text-gray-900">Mi perfil</h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Consulta tu cuenta y los datos asociados a tu usuario.
                </p>

                <span class="mt-4 inline-block text-sm font-semibold text-emerald-700 group-hover:text-emerald-800">
                    Ver mi perfil →
                </span>
            </a>

        </div>
    </section>

    {{-- Información de compra --}}
    <section class="rounded-xl border border-amber-200 bg-amber-50 p-6 sm:p-7">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    ¿Encontraste el mueble que buscas?
                </h2>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600">
                    Selecciona los muebles disponibles, indica las cantidades
                    y solicita una cotización. Podrás consultar la respuesta
                    desde tu cuenta.
                </p>
            </div>

            <a href="{{ route('catalogo') }}"
               class="inline-flex shrink-0 items-center justify-center rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                Comprar muebles
            </a>
        </div>
    </section>

</div>

@endsection
