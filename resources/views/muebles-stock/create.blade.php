@extends('layouts.admin')

@section('title', 'Nuevo Mueble')
@section('page-title', 'Nuevo Mueble')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Encabezado --}}
    <div class="mb-8">
        <a href="{{ route('muebles-stock.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 transition hover:text-gray-900">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Registrar Mueble
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Registra un mueble y controla la cantidad disponible en stock.
        </p>
    </div>


    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <i data-lucide="circle-alert"
                   class="mt-0.5 h-5 w-5 shrink-0 text-red-600">
                </i>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Revisa los siguientes campos:
                    </p>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>
    @endif


    {{-- Formulario --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <form
            action="{{ route('muebles-stock.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6 sm:p-8"
        >

            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                {{-- Nombre --}}
                <div>

                    <label
                        for="nombre"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Nombre del mueble
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ej. Escritorio Ejecutivo"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>


                {{-- Categoría --}}
                <div>

                    <label
                        for="categoria_id"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Categoría
                    </label>

                    <select
                        id="categoria_id"
                        name="categoria_id"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                        <option value="">
                            Seleccionar categoría
                        </option>

                        @forelse ($categorias as $categoria)

                            <option
                                value="{{ $categoria->id }}"
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
                            >
                                {{ $categoria->nombre }}
                            </option>

                        @empty

                            <option value="" disabled>
                                No hay categorías activas
                            </option>

                        @endforelse

                    </select>

                </div>


                {{-- Precio --}}
                <div>

                    <label
                        for="precio"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Precio de venta
                    </label>

                    <div class="relative">

                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-4 text-sm text-gray-500"
                        >
                            Bs.
                        </span>

                        <input
                            type="number"
                            id="precio"
                            name="precio"
                            value="{{ old('precio') }}"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            class="w-full rounded-xl border-gray-300 py-2.5 pl-12 pr-4 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                            required
                        >

                    </div>

                </div>


                {{-- Stock --}}
                <div>

                    <label
                        for="stock"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Stock disponible
                    </label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock', 0) }}"
                        min="0"
                        step="1"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                    <p class="mt-1.5 text-xs text-gray-500">
                        Cantidad de unidades disponibles para la venta.
                    </p>

                </div>


                {{-- Descripción --}}
                <div class="md:col-span-2">

                    <label
                        for="descripcion"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Descripción
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="4"
                        maxlength="1000"
                        placeholder="Describe brevemente el mueble..."
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                    >{{ old('descripcion') }}</textarea>

                </div>


                {{-- Imagen --}}
                <div class="md:col-span-2">

                    <label
                        for="imagen"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Imagen del mueble
                    </label>

                    <input
                        type="file"
                        id="imagen"
                        name="imagen"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="block w-full cursor-pointer rounded-xl border border-gray-300 bg-white text-sm text-gray-700
                               file:mr-4 file:border-0 file:bg-gray-900 file:px-4 file:py-2.5
                               file:text-sm file:font-semibold file:text-white
                               hover:file:bg-gray-800"
                    >

                    <p class="mt-1.5 text-xs text-gray-500">
                        Formatos permitidos: JPG, JPEG, PNG y WEBP. Máximo 2 MB.
                    </p>

                </div>


                {{-- Estado --}}
                <div>

                    <label
                        for="estado"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Estado
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                        <option
                            value="1"
                            {{ old('estado', '1') == '1' ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="0"
                            {{ old('estado') === '0' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>


            {{-- Botones --}}
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('muebles-stock.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800"
                >

                    <i data-lucide="save" class="h-4 w-4"></i>

                    Guardar Mueble

                </button>

            </div>

        </form>

    </div>

</div>

@endsection