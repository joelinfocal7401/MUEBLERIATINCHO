
<header class="sticky top-0 z-30 flex min-h-[72px] items-center justify-between gap-3 border-b border-slate-200 bg-white/95 px-4 py-3 backdrop-blur sm:px-6 lg:px-8">

    <div class="flex min-w-0 items-center gap-3">

        {{-- Hamburguesa, solo móvil --}}
        <button
            type="button"
            @click="sidebarOpen = !sidebarOpen"
            :aria-expanded="sidebarOpen.toString()"
            aria-controls="menu-cliente"
            aria-label="Abrir o cerrar menú"
            class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 text-slate-700 transition hover:bg-slate-100 md:hidden">

            <svg x-show="!sidebarOpen"
                 xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>

            <svg x-cloak x-show="sidebarOpen"
                 xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">
                <path d="m18 6-12 12M6 6l12 12"/>
            </svg>
        </button>

        <div class="min-w-0">
            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                Área de cliente
            </p>

            <h2 class="truncate text-base font-bold text-slate-900 sm:text-lg">
                Hola, {{ auth()->user()->name ?? 'Cliente' }}
            </h2>
        </div>
    </div>

    <div class="flex shrink-0 items-center gap-2">

        <a href="{{ route('home') }}"
           aria-label="Volver al inicio"
           title="Volver al inicio"
           class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 transition hover:bg-slate-100 sm:w-auto sm:px-3 sm:gap-2">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="m3 10 9-7 9 7"/>
                <path d="M5 9v11h14V9M9 20v-6h6v6"/>
            </svg>

            <span class="hidden text-sm font-medium sm:inline">Inicio</span>
        </a>

        <a href="{{ route('catalogo') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-3 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 sm:px-4">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M3 10V5h7v5H3ZM14 5h7v5h-7V5ZM3 14h7v5H3v-5ZM14 14h7v5h-7v-5Z"/>
            </svg>

            <span class="hidden sm:inline">Catálogo</span>
        </a>

    </div>

</header>
