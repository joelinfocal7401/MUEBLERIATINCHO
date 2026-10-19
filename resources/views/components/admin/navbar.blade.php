@php
    $user = auth()->user();
@endphp

<header class="sticky top-0 z-40 border-b border-gray-200 bg-white">

    <div class="flex h-16 items-center justify-between px-4 sm:px-6">

        {{-- Parte izquierda --}}
        <div class="flex items-center gap-3">

            {{-- Botón para abrir/cerrar sidebar en móvil --}}
            <button
                type="button"
                @click="sidebarOpen = !sidebarOpen"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 lg:hidden"
                aria-label="Abrir menú"
            >
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>


            {{-- Título de la página --}}
            <div>

                <h2 class="text-sm font-semibold text-gray-900 sm:text-base">
                    @yield('page-title', 'Dashboard')
                </h2>

                <p class="hidden text-xs text-gray-500 sm:block">
                    Panel de administración
                </p>

            </div>

        </div>


        {{-- Parte derecha --}}
        <div class="flex items-center gap-2 sm:gap-4">

            {{-- Notificaciones --}}
            <button
                type="button"
                class="relative flex h-10 w-10 items-center justify-center rounded-xl text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
                aria-label="Notificaciones"
            >

                <i data-lucide="bell" class="h-5 w-5"></i>

                {{-- Indicador de notificación --}}
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>

            </button>


            {{-- Información del usuario --}}
            <div class="hidden items-center gap-3 border-l border-gray-200 pl-4 sm:flex">

                {{-- Avatar --}}
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 text-sm font-semibold text-white">
                    {{ strtoupper(substr($user->nombre ?? $user->name ?? 'A', 0, 1)) }}
                </div>


                {{-- Nombre y rol --}}
                <div class="max-w-32">

                    <p class="truncate text-sm font-semibold text-gray-900">
                        {{ $user->nombre ?? $user->name ?? 'Administrador' }}
                    </p>

                    <p class="truncate text-xs text-gray-500">
                        Administrador
                    </p>

                </div>

            </div>

        </div>

    </div>

</header>