@extends('layouts.admin')

@section('title', 'Detalle del Pedido')

@section('page-title', 'Detalle del Pedido')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('pedidos.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Pedido {{ $pedido->codigo }}
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa del pedido.
        </p>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- DATOS CLIENTE --}}
        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <h2 class="text-lg font-semibold mb-4">
                Cliente
            </h2>

            <div class="space-y-3">

                <div>
                    <span class="font-medium">
                        Nombre:
                    </span>

                    {{ $pedido->cliente->nombre ?? '-' }}
                    {{ $pedido->cliente->apellido ?? '' }}
                </div>

                <div>
                    <span class="font-medium">
                        Correo:
                    </span>

                    {{ $pedido->cliente->email ?? '-' }}
                </div>

            </div>

        </div>

        {{-- DATOS PEDIDO --}}
        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <h2 class="text-lg font-semibold mb-4">
                Pedido
            </h2>

            <div class="space-y-3">

                <div>
                    <span class="font-medium">
                        Código:
                    </span>

                    {{ $pedido->codigo }}
                </div>

                <div>
                    <span class="font-medium">
                        Categoría:
                    </span>

                    {{ $pedido->categoria->nombre ?? '-' }}
                </div>

                <div>
                    <span class="font-medium">
                        Cantidad:
                    </span>

                    {{ $pedido->cantidad }}
                </div>

            </div>

        </div>

        {{-- MEDIDAS --}}
        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <h2 class="text-lg font-semibold mb-4">
                Medidas
            </h2>

            <div class="space-y-3">

                <div>

                    <span class="font-medium">
                        Ancho:
                    </span>

                    {{ $pedido->ancho }} m

                </div>

                <div>

                    <span class="font-medium">
                        Alto:
                    </span>

                    {{ $pedido->alto }} m

                </div>

                <div>

                    <span class="font-medium">
                        Profundidad:
                    </span>

                    {{ $pedido->profundidad }} m

                </div>

            </div>

        </div>

        {{-- ENTREGA --}}
        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <h2 class="text-lg font-semibold mb-4">
                Entrega
            </h2>

            <div class="space-y-3">

                <div>

                    <span class="font-medium">
                        Tipo:
                    </span>

                    @if($pedido->tipo_entrega == 'tienda')

                        Recoger en tienda

                    @else

                        Transporte

                    @endif

                </div>

                @if($pedido->tipo_entrega == 'transporte')

                    <div>

                        <span class="font-medium">
                            Dirección:
                        </span>

                        {{ $pedido->direccion_entrega }}

                    </div>

                @endif

            </div>

        </div>

    </div>

    {{-- COLOR --}}
    <div class="mt-6 bg-white border rounded-2xl p-6 shadow-sm">

        <h2 class="text-lg font-semibold mb-4">
            Color Seleccionado
        </h2>

        <div class="max-w-xs">

            <img
                src="{{ asset('storage/colores/'.$pedido->color.($pedido->color == 'gris' ? '.png' : '.jpg')) }}"
                class="rounded-xl border"
            >

            <p class="text-center mt-3 font-medium">

                {{ ucfirst($pedido->color) }}

            </p>

        </div>

    </div>

    {{-- OBSERVACIONES --}}
    <div class="mt-6 bg-white border rounded-2xl p-6 shadow-sm">

        <h2 class="text-lg font-semibold mb-4">
            Observaciones
        </h2>

        <p class="text-gray-700">

            {{ $pedido->observaciones ?: 'Sin observaciones.' }}

        </p>

    </div>

    {{-- IMAGEN REFERENCIA --}}
    @if($pedido->imagen_referencia)

        <div class="mt-6 bg-white border rounded-2xl p-6 shadow-sm">

            <h2 class="text-lg font-semibold mb-4">
                Imagen de Referencia
            </h2>

            <img
                src="{{ asset('storage/'.$pedido->imagen_referencia) }}"
                class="max-w-md rounded-xl border"
            >

        </div>

    @endif

    {{-- COTIZACIÓN --}}
    <div class="mt-6 bg-white border rounded-2xl p-6 shadow-sm">

        <h2 class="text-lg font-semibold mb-4">
            Información de Cotización
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>

                <span class="font-medium">
                    Precio Total
                </span>

                <p>
                    Bs. {{ number_format($pedido->precio_total, 2) }}
                </p>

            </div>

            <div>

                <span class="font-medium">
                    Adelanto
                </span>

                <p>
                    Bs. {{ number_format($pedido->adelanto, 2) }}
                </p>

            </div>

            <div>

                <span class="font-medium">
                    Fecha Entrega
                </span>

                <p>

                    {{ optional($pedido->fecha_entrega)->format('d/m/Y') }}

                </p>

            </div>

            <div>

                <span class="font-medium">
                    Estado
                </span>

                <p>

                    {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}

                </p>

            </div>

        </div>

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('pedidos.edit', $pedido->id) }}"
            class="rounded-xl bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700"
        >
            Editar
        </a>

        <a
            href="{{ route('pedidos.index') }}"
            class="rounded-xl border border-gray-300 px-5 py-2.5"
        >
            Volver
        </a>

    </div>

</div>

@endsection