@extends('layouts.admin')

@section('title', 'Detalle Proveedor')

@section('page-title', 'Detalle Proveedor')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('proveedores.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Detalle del Proveedor
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa del proveedor registrado.
        </p>

    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $proveedor->empresa }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $proveedor->nombre }}
                    </p>

                </div>

                <div>

                    @if($proveedor->estado)

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

        </div>

        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            <div>
                <p class="text-sm font-medium text-gray-500">
                    Nombre del contacto
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->nombre }}
                </p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">
                    Empresa
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->empresa }}
                </p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">
                    Teléfono
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->telefono }}
                </p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">
                    Correo
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->correo ?: 'No registrado' }}
                </p>
            </div>

            <div class="md:col-span-2">

                <p class="text-sm font-medium text-gray-500">
                    Dirección
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->direccion ?: 'No registrada' }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Estado
                </p>

                <div class="mt-2">

                    @if($proveedor->estado)

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

                <p class="text-sm font-medium text-gray-500">
                    Fecha de registro
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $proveedor->created_at?->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex flex-col justify-end gap-3 sm:flex-row">

                <a
                    href="{{ route('proveedores.edit', $proveedor->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    <i data-lucide="pencil"></i>
                    Editar
                </a>

                <a
                    href="{{ route('proveedores.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection