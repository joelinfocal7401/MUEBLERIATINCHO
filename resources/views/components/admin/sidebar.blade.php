
@php

    $user = auth()->user();

@endphp


<aside

    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-gray-200 bg-white shadow-sm transition-transform duration-300 lg:translate-x-0"

    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"

>

    <div class="flex h-20 items-center border-b border-gray-200 px-6">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-900 text-white">

                <i data-lucide="armchair" class="h-5 w-5"></i>

            </div>

            <div>

                <h1 class="text-base font-bold tracking-tight text-gray-900">

                    Mueblería Tincho

                </h1>

                <p class="text-xs text-gray-500">

                    Panel administrativo

                </p>

            </div>

        </a>

    </div>


    {{-- Navegación --}}

    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400">

            Menú principal

        </p>

        <div class="space-y-1">
            {{-- Dashboard --}}

            <a

                href="{{ route('dashboard') }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition

                {{ request()->routeIs('dashboard')

                    ? 'bg-gray-900 text-white shadow-sm'

                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"

            >

                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>

                <span>Dashboard</span>

            </a>


            {{-- Usuarios --}}

            <a

                href="{{ Route::has('usuarios.index') ? route('usuarios.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >
                <i data-lucide="users" class="h-5 w-5"></i>

                <span>Usuarios</span>
            </a>



            {{-- Categorías --}}

            <a

                href="{{ Route::has('categorias.index') ? route('categorias.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >
                <i data-lucide="tags" class="h-5 w-5"></i>

                <span>Categorías</span>

            </a>



            {{-- Proveedores --}}

            <a

                href="{{ Route::has('proveedores.index') ? route('proveedores.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >
                <i data-lucide="truck" class="h-5 w-5"></i>

                <span>Proveedores</span>

            </a>


            {{-- Materiales --}}

            <a

                href="{{ Route::has('materiales.index') ? route('materiales.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >

                <i data-lucide="package" class="h-5 w-5"></i>

                <span>Materiales</span>

            </a>



            {{-- Muebles / Stock --}}

            <a

                href="{{ Route::has('muebles-stock.index') ? route('muebles-stock.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >

                <i data-lucide="warehouse" class="h-5 w-5"></i>



                <span>Muebles / Stock</span>

            </a>


            {{-- Pedidos --}}

            <a

                href="{{ Route::has('pedidos.index') ? route('pedidos.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"

            >

                <i data-lucide="clipboard-list" class="h-5 w-5"></i>

                <span>Pedidos</span>

            </a>


            {{-- Ventas --}}

            <!-- <a

                href="{{ Route::has('ventas.index') ? route('ventas.index') : '#' }}"

                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900" >

                <i data-lucide="shopping-cart" class="h-5 w-5"></i>

                <span>Ventas</span>

            </a> -->

            <a
                href="{{ route('ventas.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                {{ request()->routeIs('ventas.*')
                    ? 'bg-gray-900 text-white shadow-sm'
                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                <span>Ventas</span>
            </a>

            {{-- Solicitudes de compra web --}}
            <a
                href="{{ route('solicitudes-web.index') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                {{ request()->routeIs('solicitudes-web.index', 'solicitudes-web.cotizar', 'solicitudes-web.guardar-cotizacion')
                    ? 'bg-gray-900 text-white shadow-sm'
                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <i data-lucide="shopping-bag" class="h-5 w-5"></i>
                <span>Solicitudes web</span>
            </a>

            {{-- Pagos notificados --}}
            <a
                href="{{ route('solicitudes-web.pagos-notificados') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                {{ request()->routeIs('solicitudes-web.pagos-notificados', 'solicitudes-web.confirmar-pago')
                    ? 'bg-gray-900 text-white shadow-sm'
                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <i data-lucide="badge-check" class="h-5 w-5"></i>
                <span>Pagos notificados</span>
            </a>


        </div>



        {{-- Separación antes de cerrar sesión --}}

        <div class="my-6 border-t border-gray-200"></div>


        {{-- Cerrar sesión --}}

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button

                type="submit"

                class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-red-50 hover:text-red-600"

            >

                <i data-lucide="log-out" class="h-5 w-5"></i>

                <span>Cerrar sesión</span>

            </button>

        </form>



    </nav>


    {{-- Usuario actual --}}

    <div class="border-t border-gray-200 p-4">

        <div class="flex items-center gap-3">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-semibold text-white">

                {{ strtoupper(substr($user->nombre ?? $user->name ?? 'A', 0, 1)) }}

            </div>



            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-gray-900">

                    {{ $user->nombre ?? $user->name ?? 'Administrador' }}

                </p>

                <p class="truncate text-xs text-gray-500">

                    {{ $user->email ?? '' }}

                </p>

            </div>

        </div>

    </div>

</aside>