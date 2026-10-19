@extends('layouts.admin')

@section('title', 'Nuevo Pedido')

@section('page-title', 'Nuevo Pedido')

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
            Registrar Pedido
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Registrar pedido personalizado.
        </p>

    </div>

    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <ul class="list-disc pl-5 text-sm text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

        <form
            action="{{ route('pedidos.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6"
        >

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Cliente --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Cliente
                    </label>

                    <select
                        name="cliente_id"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="">
                            Seleccionar cliente
                        </option>

                        @foreach($clientes as $cliente)

                            <option value="{{ $cliente->id }}">

                                {{ $cliente->nombre }}
                                {{ $cliente->apellido }}

                                -
                                {{ $cliente->email }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Categoría --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Categoría
                    </label>

                    <select
                        name="categoria_id"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="">
                            Seleccionar categoría
                        </option>

                        @foreach($categorias as $categoria)

                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Cantidad --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Cantidad
                    </label>

                    <input
                        type="number"
                        name="cantidad"
                        min="1"
                        max="4"
                        value="1"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Ancho --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Ancho (Máx. 2.20 m)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        max="2.20"
                        name="ancho"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Alto --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Alto (Máx. 2.40 m)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        max="2.40"
                        name="alto"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Profundidad --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Profundidad (Máx. 0.60 m)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        max="0.60"
                        name="profundidad"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

            </div>

            {{-- COLORES --}}

            <div class="mt-8">

                <h3 class="text-lg font-semibold mb-4">
                    Seleccione un color
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    @php

                        $colores = [
                            'blanco',
                            'cenizo',
                            'cerezo',
                            'gris',
                            'nogal',
                            'wengue'
                        ];

                    @endphp

                    @foreach($colores as $color)

                        <label
                            class="border rounded-xl p-3 cursor-pointer hover:border-gray-900"
                        >

                            <input
                                type="radio"
                                name="color"
                                value="{{ $color }}"
                                required
                            >

                            <img
                                src="{{ asset('storage/colores/'.$color.( $color == 'gris' ? '.png' : '.jpg')) }}"
                                class="w-full h-32 object-cover rounded-lg mt-2"
                            >

                            <p class="text-center mt-2 text-sm font-medium">
                                {{ ucfirst($color) }}
                            </p>

                        </label>

                    @endforeach

                </div>

            </div>

            {{-- Observaciones --}}

            <div class="mt-8">

                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    rows="4"
                    class="w-full rounded-xl border-gray-300"
                ></textarea>

            </div>

            {{-- Imagen referencia --}}

            <div class="mt-8">

                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Imagen de referencia (Opcional)

                </label>

                <input
                    type="file"
                    name="imagen_referencia"
                    accept="image/*"
                    class="w-full"
                >

            </div>

            {{-- Tipo entrega --}}

            <div class="mt-8">

                <label class="block mb-3 text-sm font-medium text-gray-700">

                    Tipo de entrega

                </label>

                <div class="flex gap-6">

                    <label>

                        <input
                            type="radio"
                            name="tipo_entrega"
                            value="tienda"
                            checked
                        >

                        Recoger en tienda

                    </label>

                    <label>

                        <input
                            type="radio"
                            name="tipo_entrega"
                            value="transporte"
                        >

                        Requiere transporte

                    </label>

                </div>

            </div>

            {{-- Dirección --}}

            <div
                id="direccionContainer"
                class="mt-6 hidden"
            >

                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Dirección de entrega

                </label>

                <textarea
                    name="direccion_entrega"
                    rows="3"
                    class="w-full rounded-xl border-gray-300"
                ></textarea>

            </div>

            {{-- Datos cotización --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

                <div>

                    <label class="block mb-2 text-sm font-medium">

                        Precio Total

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="precio_total"
                        class="w-full rounded-xl border-gray-300"
                    >

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium">

                        Adelanto

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="adelanto"
                        class="w-full rounded-xl border-gray-300"
                    >

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium">

                        Fecha entrega

                    </label>

                    <input
                        type="date"
                        name="fecha_entrega"
                        class="w-full rounded-xl border-gray-300"
                    >

                </div>

            </div>

            {{-- Estado --}}

            <div class="mt-6">

                <label class="block mb-2 text-sm font-medium">

                    Estado

                </label>

                <select
                    name="estado"
                    class="w-full rounded-xl border-gray-300"
                >

                    <option value="pendiente_cotizacion">
                        Pendiente Cotización
                    </option>

                    <option value="cotizado">
                        Cotizado
                    </option>

                    <option value="pendiente_pago">
                        Pendiente Pago
                    </option>

                    <option value="en_proceso">
                        En Proceso
                    </option>

                    <option value="terminado">
                        Terminado
                    </option>

                    <option value="entregado">
                        Entregado
                    </option>

                    <option value="cancelado">
                        Cancelado
                    </option>

                </select>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('pedidos.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-white"
                >
                    Guardar Pedido
                </button>

            </div>

        </form>

    </div>

</div>

<script>

document
.querySelectorAll(
    'input[name="tipo_entrega"]'
)
.forEach(item => {

    item.addEventListener(
        'change',
        function() {

            const direccion =
            document.getElementById(
                'direccionContainer'
            );

            if(
                this.value === 'transporte'
            ) {

                direccion.classList.remove(
                    'hidden'
                );

            } else {

                direccion.classList.add(
                    'hidden'
                );

            }

        }
    );

});

</script>

@endsection