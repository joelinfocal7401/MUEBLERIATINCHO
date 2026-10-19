@extends('layouts.admin')

@section('title', 'Usuarios')

@section('page-title', 'Usuarios')

@section('content')

    {{-- Encabezado --}}
    <div class="mb-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <!-- vuelve el content en rw  -->
        <!-- <div class="flex flex-row items-end justify-between gap-4"> -->                
            <div>
                <p class="text-sm font-medium text-gray-500">
                    Administración
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Usuarios
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Administra los usuarios registrados en el sistema.
                </p>
            </div>

            {{-- Botón nuevo usuario --}}
            <a
                href="{{ route('usuarios.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800"
            >
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                Nuevo usuario
            </a>
 

        </div>
    </div>


    {{-- Mensajes --}}
    @if(session('success'))
        <div
            class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
        >
            <i data-lucide="circle-check" class="mt-0.5 h-5 w-5 shrink-0"></i>

            <p>
                {{ session('success') }}
            </p>
        </div>
    @endif


    @if(session('error'))
        <div
            class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
        >
            <i data-lucide="circle-alert" class="mt-0.5 h-5 w-5 shrink-0"></i>

            <p>
                {{ session('error') }}
            </p>
        </div>
    @endif


    {{-- Contenedor principal --}}
    <div
        x-data="{
            search: '',
            matchesSearch(nombre, apellido, email, rol, estado) {
                const texto = (
                    nombre + ' ' +
                    apellido + ' ' +
                    email + ' ' +
                    rol + ' ' +
                    estado
                ).toLowerCase();

                return texto.includes(this.search.toLowerCase());
            }
        }"
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
    >

        {{-- Barra superior --}}
        <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-base font-semibold text-gray-900">
                        Usuarios registrados
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Gestiona las cuentas y permisos de los usuarios.
                    </p>
                </div>


                {{-- Buscador --}}
                <div class="relative w-full lg:max-w-sm">

                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="search" class="h-4 w-4 text-gray-400"></i>
                    </div>

                    <input
                        type="text"
                        x-model="search"
                        placeholder="Buscar usuario..."
                        class="block w-full rounded-xl border-gray-300 py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-900 focus:ring-gray-900"
                    >

                </div>

            </div>

        </div>


        {{-- Tabla --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] text-left">

                <thead class="border-b border-gray-200 bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Usuario
                        </th>

                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Teléfono
                        </th>

                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Rol
                        </th>

                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Registro
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($usuarios as $usuario)

                        <tr
                            x-show="matchesSearch(
                                '{{ addslashes($usuario->nombre ?? $usuario->name ?? '') }}',
                                '{{ addslashes($usuario->apellido ?? '') }}',
                                '{{ addslashes($usuario->email ?? '') }}',
                                '{{ addslashes($usuario->rol ?? '') }}',
                                '{{ addslashes($usuario->estado ?? '') }}'
                            )"
                            x-transition
                            class="transition hover:bg-gray-50"
                        >

                            {{-- Usuario --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-semibold text-white">
                                        {{ strtoupper(substr($usuario->nombre ?? $usuario->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-gray-900">
                                            {{ $usuario->nombre ?? $usuario->name ?? 'Sin nombre' }}
                                            {{ $usuario->apellido ?? '' }}
                                        </p>

                                        <p class="truncate text-sm text-gray-500">
                                            {{ $usuario->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Teléfono --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $usuario->telefono ?? '—' }}
                            </td>


                            {{-- Rol --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if(($usuario->rol ?? '') === 'admin')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-900 px-2.5 py-1 text-xs font-semibold text-white">
                                        <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                                        Administrador
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                        <i data-lucide="user" class="h-3.5 w-3.5"></i>
                                        Cliente
                                    </span>

                                @endif

                            </td>


                            {{-- Estado --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if(($usuario->estado ?? '') === 'activo')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Activo
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        Inactivo
                                    </span>

                                @endif

                            </td>


                            {{-- Fecha --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">

                                @if($usuario->created_at)
                                    {{ $usuario->created_at->format('d/m/Y') }}
                                @else
                                    —
                                @endif

                            </td>


                            {{-- Acciones --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- Ver --}}
                                    <a
                                        href="{{ route('usuarios.show', $usuario->id) }}"
                                        title="Ver usuario"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <i data-lucide="eye" class="h-4 w-4"></i>
                                    </a>


                                    {{-- Editar --}}
                                    <a
                                        href="{{ route('usuarios.edit', $usuario->id) }}"
                                        title="Editar usuario"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>


                                    {{-- Eliminar --}}
                                    <form
                                        method="POST"
                                        action="{{ route('usuarios.destroy', $usuario->id) }}"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Eliminar usuario"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-500 transition hover:bg-red-50 hover:text-red-600"
                                        >
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">
                                        <i data-lucide="users" class="h-7 w-7 text-gray-400"></i>
                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-gray-900">
                                        No hay usuarios registrados
                                    </h3>

                                    <p class="mt-1 max-w-sm text-sm text-gray-500">
                                        Cuando registres usuarios, aparecerán aquí.
                                    </p>

                                    <a
                                        href="{{ route('usuarios.create') }}"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
                                    >
                                        <i data-lucide="user-plus" class="h-4 w-4"></i>
                                        Registrar usuario
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pie --}}
        @if($usuarios->count() > 0)

            <div class="border-t border-gray-200 bg-gray-50 px-5 py-3 sm:px-6">

                <p class="text-xs text-gray-500">
                    Total de usuarios:
                    <span class="font-semibold text-gray-700">
                        {{ $usuarios->count() }}
                    </span>
                </p>

            </div>

        @endif

    </div>

@endsection