
<aside class="flex h-full w-64 flex-col overflow-y-auto border-r border-slate-200 bg-white">

    {{-- Logo --}}
    <a href="{{ route('home') }}"
       class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 transition hover:bg-slate-50">

        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-amber-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <path d="M3 10h18v10H3z"/>
                <path d="M5 10V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/>
                <path d="M7 20v2M17 20v2M8 14h8"/>
            </svg>
        </div>

        <div class="min-w-0">
            <p class="font-bold leading-5 text-slate-900">Mueblería Tincho</p>
            <p class="text-xs text-slate-500">Panel del cliente</p>
        </div>
    </a>

    {{-- Navegación --}}
    <nav class="space-y-1 p-3">

        <p class="px-3 pb-2 pt-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
            Mi cuenta
        </p>

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
           {{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('cliente.mis-pedidos') }}"
           class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
           {{ request()->routeIs('cliente.mis-pedidos') ? 'bg-amber-50 text-amber-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <path d="M6 3h12a2 2 0 0 1 2 2v16l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z"/>
                <path d="M9 8h6M9 12h6M9 16h3"/>
            </svg>
            Mis pedidos
        </a>

        <a href="{{ route('cliente.perfil') }}"
           class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
           {{ request()->routeIs('cliente.perfil') ? 'bg-amber-50 text-amber-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21a8 8 0 0 1 16 0"/>
            </svg>
            Mi perfil
        </a>

        <p class="px-3 pb-2 pt-6 text-xs font-semibold uppercase tracking-wider text-slate-400">
            Mueblería
        </p>

        <a href="{{ route('catalogo') }}"
           class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <path d="M3 10V5h7v5H3ZM14 5h7v5h-7V5ZM3 14h7v5H3v-5ZM14 14h7v5h-7v-5Z"/>
            </svg>
            Ver catálogo
        </a>

        <a href="{{ route('home') }}"
           class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-amber-50 hover:text-amber-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8">
                <path d="m3 10 9-7 9 7"/>
                <path d="M5 9v11h14V9M9 20v-6h6v6"/>
            </svg>
            Volver al inicio
        </a>

        <div class="my-5 border-t border-slate-200"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-red-600 transition hover:bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8">
                    <path d="M10 17l5-5-5-5M15 12H3"/>
                    <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/>
                </svg>
                Cerrar sesión
            </button>
        </form>

    </nav>

    {{-- Usuario conectado --}}
    <div class="hidden border-t border-slate-200 p-4 md:block">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-900 font-semibold text-white">
                {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}
            </div>

            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-slate-800">
                    {{ auth()->user()->name ?? 'Cliente' }}
                </p>
                <p class="truncate text-xs text-slate-500">
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
        </div>
    </div>

</aside>
