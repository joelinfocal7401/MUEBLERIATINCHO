@extends('layouts.admin')

@section('title', 'Detalle Categoría')

@section('page-title', 'Detalle Categoría')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('categorias.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Detalle de Categoría
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa de la categoría seleccionada.
        </p>

    </div>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">

        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-900">
                {{ $categoria->nombre }}
            </h2>

        </div>

        <div class="p-6 space-y-6">

            <div>

                <label class="block text-sm font-medium text-gray-500">
                    Nombre
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $categoria->nombre }}
                </p>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-500">
                    Descripción
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $categoria->descripcion ?: 'Sin descripción registrada' }}
                </p>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-500">
                    Estado
                </label>

                <div class="mt-2">

                    @if($categoria->estado)

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
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
                    {{ $categoria->created_at?->format('d/m/Y H:i') }}
                </p>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-500">
                    Última Actualización
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $categoria->updated_at?->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('categorias.edit', $categoria->id) }}"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Editar
                </a>

                <a
                    href="{{ route('categorias.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection