@extends('layouts.admin')

@section('title', 'Categorías')

@section('page-title', 'Categorías')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <!-- vuelve el content en rw  -->
        <!-- <div class="flex flex-row items-end justify-between gap-4"> -->


        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Categorías de Muebles
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Administra las categorías utilizadas para clasificar muebles.
            </p>
        </div>

        <a
            href="{{ route('categorias.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800"
        >
            <i data-lucide="plus" class="w-5 h-5"></i>
            Nueva Categoría
        </a>

    </div>

    {{-- Mensaje éxito --}}
    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>

    @endif

    {{-- Tabla --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Nombre
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Descripción
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 w-40">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($categorias as $categoria)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-900">
                                    {{ $categoria->nombre }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-gray-600">

                                {{ $categoria->descripcion }}

                            </td>

                            <td class="px-6 py-4">

                                @if($categoria->estado)

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- Ver --}}
                                    <a
                                        href="{{ route('categorias.show', $categoria->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 transition hover:bg-blue-100"
                                        title="Ver"
                                    >
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>

                                    {{-- Editar --}}
                                    <a
                                        href="{{ route('categorias.edit', $categoria->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 transition hover:bg-amber-100"
                                        title="Editar"
                                    >
                                        <i data-lucide="pencil" class="w-5 h-5"></i>
                                    </a>

                                    {{-- Eliminar --}}
                                    <form
                                        action="{{ route('categorias.destroy', $categoria->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Está seguro de eliminar esta categoría?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 transition hover:bg-red-50 hover:text-red-600" 
                                            title="Eliminar"
                                        >
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <i data-lucide="folder-open" class="w-12 h-12 text-gray-300"></i>

                                    <h3 class="mt-3 text-lg font-semibold text-gray-700">
                                        No hay categorías registradas
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Comienza registrando una nueva categoría.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection