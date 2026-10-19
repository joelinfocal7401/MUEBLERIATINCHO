@extends('layouts.admin')

@section('title', 'Detalle Material')

@section('page-title', 'Detalle Material')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('materiales.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Detalle del Material
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa del material registrado.
        </p>

    </div>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">

        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-900">
                {{ $material->nombre }}
            </h2>

        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Nombre
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->nombre }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Tipo
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->tipo }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Unidad
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->unidad }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Stock Actual
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->stock }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Stock Mínimo
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->stock_minimo }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Precio Compra
                </label>

                <p class="mt-1 text-gray-900">
                    Bs {{ number_format($material->precio_compra, 2) }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Estado
                </label>

                <div class="mt-2">

                    @if($material->estado)

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                            Inactivo
                        </span>

                    @endif

                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Fecha de Registro
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $material->created_at?->format('d/m/Y H:i') }}
                </p>
            </div>

            {{-- PROVEEDOR --}}

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Proveedor
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor?->nombre ?? 'No asignado' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Empresa
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor?->empresa ?? 'No registrada' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Teléfono
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor?->telefono ?? 'No registrado' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Correo
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor?->correo ?? 'No registrado' }}
                </p>
            </div>

        </div>

        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('materiales.edit', $material->id) }}"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Editar
                </a>

                <a
                    href="{{ route('materiales.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection