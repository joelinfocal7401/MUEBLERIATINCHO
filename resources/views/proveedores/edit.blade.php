@extends('layouts.admin')

@section('title', 'Editar Proveedor')

@section('page-title', 'Editar Proveedor')

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
            Editar Proveedor
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Actualiza la información del proveedor.
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
            action="{{ route('proveedores.update', $proveedor->id) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nombre del Contacto
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre', $proveedor->nombre) }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Empresa
                    </label>

                    <input
                        type="text"
                        name="empresa"
                        value="{{ old('empresa', $proveedor->empresa) }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        value="{{ old('telefono', $proveedor->telefono) }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Correo
                    </label>

                    <input
                        type="email"
                        name="correo"
                        value="{{ old('correo', $proveedor->correo) }}"
                        class="w-full rounded-xl border-gray-300"
                    >
                </div>

                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Dirección
                    </label>

                    <textarea
                        name="direccion"
                        rows="3"
                        class="w-full rounded-xl border-gray-300"
                    >{{ old('direccion', $proveedor->direccion) }}</textarea>

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >

                        <option
                            value="1"
                            {{ $proveedor->estado ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="0"
                            {{ !$proveedor->estado ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('proveedores.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Actualizar Proveedor
                </button>

            </div>

        </form>

    </div>

</div>

@endsection