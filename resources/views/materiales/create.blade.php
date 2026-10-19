@extends('layouts.admin')

@section('title', 'Nuevo Material')

@section('page-title', 'Nuevo Material')

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
            Registrar Material
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Registra un nuevo material para la fabricación de muebles.
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
            action="{{ route('materiales.store') }}"
            method="POST"
            class="p-6"
        >

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Tipo --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Tipo
                    </label>

                    <input
                        type="text"
                        name="tipo"
                        value="{{ old('tipo') }}"
                        placeholder="Melamina, Herraje, MDF, Tornillos..."
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Unidad --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Unidad
                    </label>

                    <select
                        name="unidad"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="">Seleccione</option>

                        <option value="Unidad"
                            {{ old('unidad') == 'Unidad' ? 'selected' : '' }}>
                            Unidad
                        </option>

                        <option value="Plancha"
                            {{ old('unidad') == 'Plancha' ? 'selected' : '' }}>
                            Plancha
                        </option>

                        <option value="Par"
                            {{ old('unidad') == 'Par' ? 'selected' : '' }}>
                            Par
                        </option>

                        <option value="Metro"
                            {{ old('unidad') == 'Metro' ? 'selected' : '' }}>
                            Metro
                        </option>

                        <option value="Caja"
                            {{ old('unidad') == 'Caja' ? 'selected' : '' }}>
                            Caja
                        </option>

                        <option value="Juego"
                            {{ old('unidad') == 'Juego' ? 'selected' : '' }}>
                            Juego
                        </option>

                    </select>

                </div>

                {{-- Proveedor --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Proveedor
                    </label>

                    <select
                        name="proveedor_id"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option value="">
                            Seleccionar proveedor
                        </option>

                        @foreach ($proveedores as $proveedor)

                            <option
                                value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}
                            >
                                {{ $proveedor->nombre }}
                                @if($proveedor->empresa)
                                    - {{ $proveedor->empresa }}
                                @endif
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Stock --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Stock Actual
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock') }}"
                        min="0"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Stock mínimo --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Stock Mínimo
                    </label>

                    <input
                        type="number"
                        name="stock_minimo"
                        value="{{ old('stock_minimo') }}"
                        min="0"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                </div>

                {{-- Precio --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Precio Compra (Bs)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="precio_compra"
                        value="{{ old('precio_compra') }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

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

                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('materiales.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Guardar Material
                </button>

            </div>

        </form>

    </div>

</div>

@endsection