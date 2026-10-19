@extends('layouts.admin')

@section('title', 'Detalle del Mueble')

@section('page-title', 'Detalle del Mueble')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('muebles-stock.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Detalle del Mueble
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa del mueble registrado.
        </p>

    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">

            <h2 class="text-xl font-bold text-gray-900">
                {{ $muebleStock->nombre }}
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ $categoria?->nombre ?? 'Sin categoría' }}
            </p>

        </div>

        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            {{-- Imagen --}}
            <div class="md:col-span-2">

                <p class="mb-3 text-sm font-medium text-gray-500">
                    Imagen
                </p>

                @if($muebleStock->imagen)

                    <img
                        src="{{ asset('storage/' . $muebleStock->imagen) }}"
                        alt="{{ $muebleStock->nombre }}"
                        class="h-72 w-full rounded-xl border border-gray-200 object-cover"
                    >

                @else

                    <div class="flex h-72 items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 text-gray-400">
                        Sin imagen
                    </div>

                @endif

            </div>

            {{-- Nombre --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Nombre
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $muebleStock->nombre }}
                </p>

            </div>

            {{-- Categoría --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Categoría
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $categoria?->nombre ?? 'Sin categoría' }}
                </p>

            </div>

            {{-- Precio --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Precio
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    Bs {{ number_format($muebleStock->precio, 2) }}
                </p>

            </div>

            {{-- Stock --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Stock Disponible
                </p>

                @if($muebleStock->stock <= 0)

                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                        Sin stock
                    </span>

                @elseif($muebleStock->stock <= 3)

                    <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                        Stock bajo ({{ $muebleStock->stock }})
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                        {{ $muebleStock->stock }} disponibles
                    </span>

                @endif

            </div>

            {{-- Descripción --}}
            <div class="md:col-span-2">

                <p class="text-sm font-medium text-gray-500">
                    Descripción
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $muebleStock->descripcion ?: 'Sin descripción registrada.' }}
                </p>

            </div>

            {{-- Estado --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Estado
                </p>

                @if($muebleStock->estado)

                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                        Activo
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                        Inactivo
                    </span>

                @endif

            </div>

            {{-- Fecha --}}
            <div>

                <p class="text-sm font-medium text-gray-500">
                    Fecha de Registro
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $muebleStock->created_at?->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('muebles-stock.edit', $muebleStock->id) }}"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Editar
                </a>

                <a
                    href="{{ route('muebles-stock.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection