@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('page-title', 'Editar Usuario')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('usuarios.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Volver a usuarios
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Editar Usuario
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Modifique la información del usuario.
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
            action="{{ route('usuarios.update', $usuario->id) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre', $usuario->nombre) }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido"
                        value="{{ old('apellido', $usuario->apellido) }}"
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
                        value="{{ old('telefono', $usuario->telefono) }}"
                        class="w-full rounded-xl border-gray-300"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $usuario->email) }}"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Rol
                    </label>

                    <select
                        name="rol"
                        class="w-full rounded-xl border-gray-300"
                        required
                    >
                        <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>
                            Administrador
                        </option>

                        <option value="cliente" {{ $usuario->rol == 'cliente' ? 'selected' : '' }}>
                            Cliente
                        </option>
                    </select>
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
                        <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="inactivo" {{ $usuario->estado == 'inactivo' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-xl border-gray-300"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Déjelo vacío si no desea cambiarla.
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-xl border-gray-300"
                    >
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('usuarios.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Actualizar Usuario
                </button>

            </div>

        </form>

    </div>

</div>

@endsection