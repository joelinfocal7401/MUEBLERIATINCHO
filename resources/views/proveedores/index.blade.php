@extends('layouts.admin')

@section('title', 'Proveedores')

@section('page-title', 'Proveedores')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Proveedores
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Gestiona los proveedores de materiales para la fabricación de muebles.
            </p>
        </div>

        <a
            href="{{ route('proveedores.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800"
        >
            <i data-lucide="plus"></i>
            Nuevo Proveedor
        </a>

    </div>

    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>

    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Nombre
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Empresa
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Teléfono
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Correo
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($proveedores as $proveedor)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $proveedor->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $proveedor->empresa }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $proveedor->telefono }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $proveedor->correo }}
                            </td>

                            <td class="px-6 py-4">

                                @if($proveedor->estado)

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('proveedores.show', $proveedor->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100"
                                    >
                                        <i data-lucide="eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('proveedores.edit', $proveedor->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-amber-600 hover:bg-amber-100"
                                    >
                                        <i data-lucide="pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('proveedores.destroy', $proveedor->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar proveedor?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-red-600 hover:bg-red-100"
                                        >
                                            <i data-lucide="trash-2"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No existen proveedores registrados.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection