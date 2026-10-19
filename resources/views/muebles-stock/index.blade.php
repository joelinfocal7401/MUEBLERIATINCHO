@extends('layouts.admin')

@section('title', 'Muebles / Stock')
@section('page-title', 'Muebles / Stock')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Muebles / Stock
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Administra los muebles disponibles y controla su stock.
            </p>
        </div>

        <a href="{{ route('muebles-stock.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Nuevo Mueble
        </a>
    </div>


    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <div class="flex items-center gap-2">
                <i data-lucide="check-circle" class="h-5 w-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif


    {{-- Tabla --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Vista móvil --}}
        <div class="divide-y divide-gray-200 md:hidden">

            @forelse ($muebles as $mueble)

                <div class="p-4">

                    <div class="flex items-start justify-between gap-4">

                        <div class="min-w-0">
                            <h3 class="truncate font-semibold text-gray-900">
                                {{ $mueble->nombre }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $mueble->descripcion ?: 'Sin descripción' }}
                            </p>
                        </div>

                        @if ($mueble->estado)
                            <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                Activo
                            </span>
                        @else
                            <span class="shrink-0 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                Inactivo
                            </span>
                        @endif

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">

                        <div>
                            <p class="text-gray-500">Precio</p>
                            <p class="mt-1 font-semibold text-gray-900">
                                Bs. {{ number_format($mueble->precio, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Stock</p>

                            @if ($mueble->stock <= 0)

                                <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                    <i data-lucide="circle-alert" class="h-3.5 w-3.5"></i>
                                    Sin stock
                                </span>

                            @elseif ($mueble->stock <= 2)

                                <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-700">
                                    <i data-lucide="triangle-alert" class="h-3.5 w-3.5"></i>
                                    {{ $mueble->stock }} disponibles
                                </span>

                            @else

                                <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                    <i data-lucide="package-check" class="h-3.5 w-3.5"></i>
                                    {{ $mueble->stock }} disponibles
                                </span>

                            @endif
                        </div>

                    </div>


                    <div class="mt-4 flex items-center justify-end gap-2">

                        <a href="{{ route('muebles-stock.show', $mueble->id) }}"
                           class="rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                           title="Ver">
                            <i data-lucide="eye" class="h-4 w-4"></i>
                        </a>

                        <a href="{{ route('muebles-stock.edit', $mueble->id) }}"
                           class="rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                           title="Editar">
                            <i data-lucide="pencil" class="h-4 w-4"></i>
                        </a>

                        <form action="{{ route('muebles-stock.destroy', $mueble->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este mueble?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="rounded-lg p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-600"
                                    title="Eliminar">
                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="px-6 py-12 text-center">
                    <i data-lucide="armchair" class="mx-auto h-10 w-10 text-gray-300"></i>

                    <h3 class="mt-4 text-sm font-semibold text-gray-900">
                        No hay muebles registrados
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Comienza registrando el primer mueble.
                    </p>
                </div>

            @endforelse

        </div>


        {{-- Vista escritorio --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Mueble
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Categoría
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Precio
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($muebles as $mueble)

                        <tr class="transition hover:bg-gray-50">

                            {{-- Mueble --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">
                                        <i data-lucide="armchair" class="h-5 w-5"></i>
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-gray-900">
                                            {{ $mueble->nombre }}
                                        </p>

                                        <p class="mt-0.5 max-w-xs truncate text-xs text-gray-500">
                                            {{ $mueble->descripcion ?: 'Sin descripción' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Categoría --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                @php
                                    $categoria = \App\Models\CategoriaMueble::find($mueble->categoria_id);
                                @endphp

                                {{ $categoria?->nombre ?? 'Sin categoría' }}

                            </td>


                            {{-- Precio --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">

                                Bs. {{ number_format($mueble->precio, 2) }}

                            </td>


                            {{-- Stock --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($mueble->stock <= 0)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        <i data-lucide="circle-alert" class="h-3.5 w-3.5"></i>
                                        Sin stock
                                    </span>

                                @elseif ($mueble->stock <= 2)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-700">
                                        <i data-lucide="triangle-alert" class="h-3.5 w-3.5"></i>
                                        {{ $mueble->stock }}
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        <i data-lucide="package-check" class="h-3.5 w-3.5"></i>
                                        {{ $mueble->stock }}
                                    </span>

                                @endif

                            </td>


                            {{-- Estado --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($mueble->estado)

                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>


                            {{-- Acciones --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex justify-end gap-1">

                                    <a href="{{ route('muebles-stock.show', $mueble->id) }}"
                                       class="rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                                       title="Ver">
                                        <i data-lucide="eye" class="h-4 w-4"></i>
                                    </a>

                                    <a href="{{ route('muebles-stock.edit', $mueble->id) }}"
                                       class="rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                                       title="Editar">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>

                                    <form action="{{ route('muebles-stock.destroy', $mueble->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este mueble?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-600"
                                                title="Eliminar">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-12 text-center">

                                <i data-lucide="armchair" class="mx-auto h-10 w-10 text-gray-300"></i>

                                <h3 class="mt-4 text-sm font-semibold text-gray-900">
                                    No hay muebles registrados
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Comienza registrando el primer mueble.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection