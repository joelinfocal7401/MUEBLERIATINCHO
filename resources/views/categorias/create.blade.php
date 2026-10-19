@extends('layouts.admin')

@section('title', 'Nueva Categoría')

@section('page-title', 'Nueva Categoría')

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
            Registrar Categoría
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Registra una nueva categoría para clasificar muebles.
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
            action="{{ route('categorias.store') }}"
            method="POST"
            class="p-6"
        >

            @csrf

            <div class="space-y-6">

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
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
                    >{{ old('descripcion') }}</textarea>

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
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
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
                    Guardar Categoría
                </button>

            </div>

        </form>

    </div>

</div>

@endsection