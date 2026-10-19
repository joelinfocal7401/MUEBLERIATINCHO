@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Encabezado --}}
    <div class="mb-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-medium text-gray-500">
                    Panel administrativo
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Bienvenido, {{ auth()->user()->nombre ?? auth()->user()->name ?? 'Administrador' }}
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Aquí puedes controlar las principales operaciones de Mueblería Tincho.
                </p>
            </div>

            <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 shadow-sm">
                <i data-lucide="calendar-days" class="h-4 w-4 text-gray-500"></i>

                <span class="text-sm font-medium text-gray-700">
                    {{ now()->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>


    {{-- Tarjetas principales --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Usuarios --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Usuarios
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        0
                    </p>

                    <p class="mt-2 text-xs text-gray-500">
                        Usuarios registrados
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">
                    <i data-lucide="users" class="h-5 w-5 text-gray-700"></i>
                </div>
            </div>
        </div>


        {{-- Pedidos --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Pedidos
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        0
                    </p>

                    <p class="mt-2 text-xs text-gray-500">
                        Pendientes de atención
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">
                    <i data-lucide="clipboard-list" class="h-5 w-5 text-gray-700"></i>
                </div>
            </div>
        </div>


        {{-- Ventas --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Ventas
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        Bs. 0
                    </p>

                    <p class="mt-2 text-xs text-gray-500">
                        Ventas registradas
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">
                    <i data-lucide="shopping-cart" class="h-5 w-5 text-gray-700"></i>
                </div>
            </div>
        </div>


        {{-- Stock --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Stock
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        0
                    </p>

                    <p class="mt-2 text-xs text-gray-500">
                        Materiales disponibles
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">
                    <i data-lucide="package" class="h-5 w-5 text-gray-700"></i>
                </div>
            </div>
        </div>

    </div>


    {{-- Contenido principal --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Pedidos recientes --}}
        <div class="xl:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 sm:px-6">

                    <div>
                        <h2 class="text-base font-semibold text-gray-900">
                            Pedidos recientes
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Últimos pedidos registrados en el sistema.
                        </p>
                    </div>

                    <a
                        href="{{ Route::has('pedidos.index') ? route('pedidos.index') : '#' }}"
                        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
                    >
                        Ver todos

                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>

                </div>


                {{-- Estado vacío --}}
                <div class="flex min-h-[260px] flex-col items-center justify-center px-6 py-10 text-center">

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">
                        <i data-lucide="clipboard-list" class="h-7 w-7 text-gray-400"></i>
                    </div>

                    <h3 class="mt-4 text-sm font-semibold text-gray-900">
                        No hay pedidos registrados
                    </h3>

                    <p class="mt-1 max-w-sm text-sm text-gray-500">
                        Cuando los clientes realicen pedidos, aquí aparecerá un resumen de los más recientes.
                    </p>

                </div>

            </div>

        </div>


        {{-- Alertas --}}
        <div>

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100">
                            <i data-lucide="bell" class="h-5 w-5 text-gray-700"></i>
                        </div>

                        <div>
                            <h2 class="text-base font-semibold text-gray-900">
                                Alertas
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                Situaciones que requieren atención.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="space-y-3 p-5">

                    {{-- Stock bajo --}}
                    <div class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4">

                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white">
                            <i data-lucide="package-search" class="h-4 w-4 text-gray-600"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-800">
                                Stock bajo
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                No existen materiales con stock bajo actualmente.
                            </p>
                        </div>

                    </div>


                    {{-- Pedidos pendientes --}}
                    <div class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4">

                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white">
                            <i data-lucide="clock-3" class="h-4 w-4 text-gray-600"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-800">
                                Pedidos pendientes
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                No hay pedidos pendientes de atención.
                            </p>
                        </div>

                    </div>


                    {{-- Pedidos retrasados --}}
                    <div class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4">

                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white">
                            <i data-lucide="calendar-clock" class="h-4 w-4 text-gray-600"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-800">
                                Entregas
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                No existen entregas retrasadas.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Acciones rápidas --}}
    <div class="mt-6">

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5">
                <h2 class="text-base font-semibold text-gray-900">
                    Acciones rápidas
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Accede rápidamente a las operaciones principales.
                </p>
            </div>


            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Registrar usuario --}}
                <a
                    href="{{ Route::has('usuarios.create') ? route('usuarios.create') : '#' }}"
                    class="group flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 transition group-hover:bg-gray-200">
                        <i data-lucide="user-plus" class="h-5 w-5 text-gray-700"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Nuevo usuario
                        </p>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Registrar usuario
                        </p>
                    </div>
                </a>


                {{-- Nuevo pedido --}}
                <a
                    href="{{ Route::has('pedidos.create') ? route('pedidos.create') : '#' }}"
                    class="group flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 transition group-hover:bg-gray-200">
                        <i data-lucide="file-plus-2" class="h-5 w-5 text-gray-700"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Nuevo pedido
                        </p>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Registrar pedido
                        </p>
                    </div>
                </a>


                {{-- Registrar venta --}}
                <a
                    href="{{ Route::has('ventas.create') ? route('ventas.create') : '#' }}"
                    class="group flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 transition group-hover:bg-gray-200">
                        <i data-lucide="shopping-bag" class="h-5 w-5 text-gray-700"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Nueva venta
                        </p>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Registrar venta
                        </p>
                    </div>
                </a>


                {{-- Ver materiales --}}
                <a
                    href="{{ Route::has('materiales.index') ? route('materiales.index') : '#' }}"
                    class="group flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 transition group-hover:bg-gray-200">
                        <i data-lucide="boxes" class="h-5 w-5 text-gray-700"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Ver materiales
                        </p>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Controlar stock
                        </p>
                    </div>
                </a>

            </div>

        </div>

    </div>

@endsection