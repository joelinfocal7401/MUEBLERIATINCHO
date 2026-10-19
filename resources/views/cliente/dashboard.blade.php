@extends('layouts.cliente')

@section('title', 'Dashboard del Cliente')
@section('page-title', 'Panel Principal')

@section('content')

<div class="space-y-6">

    {{-- Encabezado de bienvenida --}}
    <section class="relative overflow-hidden rounded-2xl border border-amber-900/10 bg-gradient-to-r from-amber-800 to-stone-900 p-6 text-white shadow-sm sm:p-8">

        {{-- Decoración de fondo --}}
        <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-amber-400/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-16 right-24 h-48 w-48 rounded-full bg-white/5 blur-3xl"></div>

        <div class="relative z-10 max-w-3xl">

            <span class="inline-flex items-center gap-2 rounded-full border border-amber-400/20 bg-amber-700/40 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-amber-200">
                <i data-lucide="sparkles" class="h-3.5 w-3.5"></i>
                Bienvenido de nuevo
            </span>

            <h2 class="mt-4 text-2xl font-bold tracking-tight sm:text-3xl">
                {{ Auth::user()->nombre ?? Auth::user()->name ?? 'Estimado Cliente' }} 
            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-amber-100/80 sm:text-base">
                Desde aquí puedes hacer seguimiento a tus muebles personalizados en fabricación, revisar tus presupuestos o explorar el catálogo disponible en Mueblería Tincho.
            </p>

            {{-- Acciones principales --}}
            <div class="mt-6 flex flex-wrap gap-3">

                <a
                    href="{{ route('cliente.pedidos.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm transition duration-200 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-amber-800"
                >
                    <i data-lucide="clipboard-list" class="h-4 w-4 text-amber-700"></i>
                    Ver mis pedidos
                </a>

                <a
                    href="{{ route('catalogo') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition duration-200 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-stone-900"
                >
                    <i data-lucide="shopping-bag" class="h-4 w-4"></i>
                    Catálogo de muebles
                </a>

            </div>

        </div>

    </section>


    {{-- Tarjetas de estadísticas --}}
    <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        {{-- Pedidos activos --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-start justify-between gap-4">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Pedidos activos
                    </p>

                    <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                        1
                    </h3>

                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-amber-700">
                        <i data-lucide="clock-3" class="h-3.5 w-3.5"></i>
                        En proceso de taller
                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-700 ring-1 ring-amber-100">
                    <i data-lucide="package" class="h-6 w-6"></i>
                </div>

            </div>

        </div>


        {{-- Historial de pedidos --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-start justify-between gap-4">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Historial de pedidos
                    </p>

                    <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                        3
                    </h3>

                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-emerald-700">
                        <i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i>
                        Entregados con éxito
                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100">
                    <i data-lucide="check-circle-2" class="h-6 w-6"></i>
                </div>

            </div>

        </div>


        {{-- Cotizaciones --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-start justify-between gap-4">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Cotizaciones
                    </p>

                    <h3 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                        0
                    </h3>

                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-blue-700">
                        <i data-lucide="file-check" class="h-3.5 w-3.5"></i>
                        Sin solicitudes pendientes
                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700 ring-1 ring-blue-100">
                    <i data-lucide="file-text" class="h-6 w-6"></i>
                </div>

            </div>

        </div>

    </section>


    {{-- Seguimiento y acciones secundarias --}}
    <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Seguimiento del pedido reciente --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm xl:col-span-2">

            {{-- Encabezado de la tarjeta --}}
            <div class="flex flex-col gap-3 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <div>
                    <h3 class="text-base font-semibold text-gray-900">
                        Estado de tu pedido reciente
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Seguimiento en tiempo real del taller
                    </p>
                </div>

                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-800 ring-1 ring-amber-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                    En Fabricación (Corte y Armado)
                </span>

            </div>


            {{-- Información del pedido --}}
            <div class="space-y-6 p-5 sm:p-6">

                <div class="flex flex-col gap-4 rounded-xl border border-gray-200 bg-gray-50/70 p-4 sm:flex-row sm:items-center">

                    <div class="flex h-20 w-20 shrink-0 items-center justify-center self-center rounded-xl border border-gray-200 bg-white text-gray-400 sm:self-auto">
                        <i data-lucide="armchair" class="h-9 w-9"></i>
                    </div>

                    <div class="min-w-0 flex-1 text-center sm:text-left">

                        <h4 class="text-sm font-semibold leading-5 text-gray-900">
                            Escritorio Ejecutivo en L (Melamina 18mm)
                        </h4>

                        <p class="mt-2 text-xs leading-5 text-gray-500">
                            Color: Wengue Texturizado
                            <span class="mx-1 text-gray-300">|</span>
                            Medidas: 1.50m x 1.40m
                        </p>

                        <p class="mt-2 inline-flex items-center rounded-lg bg-white px-2.5 py-1 text-xs font-semibold text-amber-800 ring-1 ring-gray-200">
                            Código: #PED-2026-042
                        </p>

                    </div>

                </div>


                {{-- Progreso visual --}}
                <div class="space-y-3">

                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">
                                Progreso del taller
                            </h4>

                            <p class="mt-1 text-xs text-gray-500">
                                Avance de fabricación
                            </p>
                        </div>

                        <span class="shrink-0 rounded-lg bg-amber-50 px-2.5 py-1 text-sm font-bold text-amber-800">
                            60%
                        </span>
                    </div>

                    <div
                        class="h-2.5 w-full overflow-hidden rounded-full bg-gray-100"
                        role="progressbar"
                        aria-label="Progreso del taller"
                        aria-valuenow="60"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div
                            class="h-full rounded-full bg-gradient-to-r from-amber-500 to-amber-700 transition-all duration-500"
                            style="width: 60%"
                        ></div>
                    </div>

                    <div class="flex justify-between text-xs text-gray-400">
                        <span>Inicio</span>
                        <span>En fabricación</span>
                        <span>Finalización</span>
                    </div>

                </div>


                {{-- Enlace al pedido --}}
                <div class="flex justify-end border-t border-gray-100 pt-4">

                    <a
                        href="{{ route('cliente.pedidos.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-amber-700 transition duration-200 hover:bg-amber-50 hover:text-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                    >
                        Ver detalle completo del pedido
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>

                </div>

            </div>

        </div>


        {{-- Columna secundaria --}}
        <div class="space-y-6">

            {{-- Acciones útiles --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200 px-5 py-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        Acciones útiles
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Accede rápidamente a tus opciones.
                    </p>
                </div>

                <div class="space-y-1 p-3">

                    {{-- Actualizar perfil --}}
                    <a
                        href="{{ route('cliente.perfil') }}"
                        class="group flex items-center justify-between gap-3 rounded-xl p-3 transition duration-200 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600 transition duration-200 group-hover:bg-amber-100 group-hover:text-amber-800">
                                <i data-lucide="user-round" class="h-5 w-5"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800">
                                    Actualizar mis datos
                                </p>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Gestionar mi perfil
                                </p>
                            </div>

                        </div>

                        <i data-lucide="chevron-right" class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-amber-700"></i>
                    </a>


                    {{-- Catálogo --}}
                    <a
                        href="{{ route('catalogo') }}"
                        class="group flex items-center justify-between gap-3 rounded-xl p-3 transition duration-200 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600 transition duration-200 group-hover:bg-amber-100 group-hover:text-amber-800">
                                <i data-lucide="shopping-bag" class="h-5 w-5"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800">
                                    Ver catálogo de muebles
                                </p>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Explorar productos
                                </p>
                            </div>

                        </div>

                        <i data-lucide="chevron-right" class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-amber-700"></i>
                    </a>

                </div>

            </div>


            {{-- Atención al cliente --}}
            <div class="relative overflow-hidden rounded-2xl bg-stone-900 p-5 text-white shadow-sm">

                {{-- Decoración --}}
                <div class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-amber-500/10 blur-2xl"></div>

                <div class="relative">

                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-400">
                        <i data-lucide="headphones" class="h-4 w-4"></i>
                        Atención al cliente
                    </div>

                    <h4 class="mt-4 text-base font-bold tracking-tight">
                        ¿Necesitas un diseño a medida?
                    </h4>

                    <p class="mt-2 text-xs leading-5 text-stone-300">
                        Comunícate directamente con nuestro taller de carpintería para coordinar dimensiones especiales o acabados en melamina.
                    </p>

                    <a
                        href="https://wa.me/59100000000"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition duration-200 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-stone-900"
                    >
                        <i data-lucide="message-circle" class="h-4 w-4"></i>
                        Escribir por WhatsApp
                        <i data-lucide="arrow-up-right" class="h-3.5 w-3.5"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endpush

@endsection