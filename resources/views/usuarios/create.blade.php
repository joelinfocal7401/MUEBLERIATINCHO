@extends('layouts.admin')

@section('title', 'Nuevo Usuario')

@section('page-title', 'Nuevo Usuario')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Encabezado --}}
    <div class="mb-8">

        <a
            href="{{ route('usuarios.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Volver a usuarios
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Registrar Usuario
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Complete la información para registrar un nuevo usuario.
        </p>

    </div>

    {{-- Errores --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <i data-lucide="circle-alert" class="h-5 w-5 text-red-600"></i>

                <div>

                    <h3 class="font-semibold text-red-700">
                        Existen errores en el formulario
                    </h3>

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
    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

        <form
            action="{{ route('usuarios.store') }}"
            method="POST"
            class="p-6"
        >

            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Nombre --}}
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

                {{-- Apellido --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido"
                        value="{{ old('apellido') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>

                {{-- Teléfono --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                    >

                </div>

                {{-- Correo --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>

                {{-- Rol --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Rol
                    </label>

                    <select
                        name="rol"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >
                        <option value="">Seleccione</option>
                        <option value="admin">Administrador</option>
                        <option value="cliente">Cliente</option>
                    </select>

                </div>

                {{-- Estado --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>

                </div>

                {{-- Password --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>

                {{-- Confirmar Password --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                        required
                    >

                </div>

            </div>

            {{-- Botones --}}
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('usuarios.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-center text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Guardar Usuario
                </button>

            </div>

        </form>

    </div>

</div>

@endsection