@extends('layouts.admin')

@section('title', 'Nueva Venta')

@section('page-title', 'Nueva Venta')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('ventas.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Registrar Venta
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Registra la venta de un mueble disponible en stock.
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
            action="{{ route('ventas.store') }}"
            method="POST"
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

                            <option
                                value="{{ $cliente->id }}"
                            >
                                {{ $cliente->nombre }}
                                {{ $cliente->apellido }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Mueble --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Mueble
                    </label>

                    <select
                        name="mueble_id"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="">
                            Seleccionar mueble
                        </option>

                        @foreach($muebles as $mueble)

                            <option
                                value="{{ $mueble->id }}"
                            >
                                {{ $mueble->nombre }}
                                (Stock: {{ $mueble->stock }})
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
                        value="1"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Método Pago --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Método de Pago
                    </label>

                    <select
                        name="metodo_pago"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="Efectivo">
                            Efectivo
                        </option>

                        <option value="Transferencia">
                            Transferencia
                        </option>

                        <option value="QR">
                            QR
                        </option>

                    </select>

                </div>

                {{-- Estado --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="Pagado">
                            Pagado
                        </option>

                        <option value="Pendiente">
                            Pendiente
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('ventas.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Guardar Venta
                </button>

            </div>

        </form>

    </div>

</div>

@endsection