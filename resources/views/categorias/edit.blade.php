@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('page-title', 'Editar Categoría')

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
            Editar Categoría
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Modifique la información de la categoría.
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
            action="{{ route('categorias.update', $categoria->id) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre', $categoria->nombre) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                    >{{ old('descripcion', $categoria->descripcion) }}</textarea>

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >
                        <option value="1" {{ $categoria->estado ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="0" {{ !$categoria->estado ? 'selected' : '' }}>
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('categorias.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Actualizar Categoría
                </button>

            </div>

        </form>

    </div>

</div>

@endsection