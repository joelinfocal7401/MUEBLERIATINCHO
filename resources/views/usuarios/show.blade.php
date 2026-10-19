@extends('layouts.admin')

@section('title', 'Detalle Usuario')

@section('page-title', 'Detalle Usuario')

@section('content')

<div class="max-w-4xl mx-auto">

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
            Información del Usuario
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Visualización detallada del usuario seleccionado.
        </p>

    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Cabecera --}}
        <div class="border-b border-gray-200 px-6 py-6">

            <div class="flex flex-col items-center gap-4 sm:flex-row">

                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-900 text-2xl font-bold text-white">

                    {{ strtoupper(substr($usuario->nombre ?? $usuario->name ?? 'U', 0, 1)) }}

                </div>

                <div>

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $usuario->nombre ?? $usuario->name ?? '' }}
                        {{ $usuario->apellido ?? '' }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $usuario->email }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Información --}}
        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Nombre
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $usuario->nombre ?? '-' }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Apellido
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $usuario->apellido ?? '-' }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Correo electrónico
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $usuario->email }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Teléfono
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $usuario->telefono ?? 'No registrado' }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Rol
                </p>

                <p class="mt-1 text-gray-900">
                    {{ ucfirst($usuario->rol ?? '-') }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Estado
                </p>

                <p class="mt-1 text-gray-900">
                    {{ ucfirst($usuario->estado ?? '-') }}
                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Fecha de registro
                </p>

                <p class="mt-1 text-gray-900">
                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '-' }}
                </p>

            </div>

        </div>

        {{-- Botones --}}
        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('usuarios.edit', $usuario->id) }}"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-center text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Editar Usuario
                </a>

                <a
                    href="{{ route('usuarios.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-center text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection