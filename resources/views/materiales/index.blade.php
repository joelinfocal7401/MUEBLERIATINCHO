@extends('layouts.admin')

@section('title', 'Materiales')

@section('page-title', 'Materiales')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Materiales
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Gestiona los materiales utilizados para la fabricación de muebles.
            </p>
        </div>

        <a
            href="{{ route('materiales.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800"
        >
            <i data-lucide="plus"></i>
            Nuevo Material
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
                            Tipo
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Unidad
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Proveedor
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Precio Compra
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

                    @forelse($materiales as $material)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $material->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $material->tipo }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $material->unidad }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $material->proveedor?->nombre ?? 'Sin proveedor' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($material->stock <= 0)

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Sin stock
                                    </span>

                                @elseif($material->stock <= $material->stock_minimo)

                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        {{ $material->stock }}
                                    </span>

                                @else

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ $material->stock }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                Bs {{ number_format($material->precio_compra, 2) }}
                            </td>

                            <td class="px-6 py-4">

                                @if($material->estado)

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
                                        href="{{ route('materiales.show', $material->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100"
                                    >
                                        <i data-lucide="eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('materiales.edit', $material->id) }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-amber-600 hover:bg-amber-100"
                                    >
                                        <i data-lucide="pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('materiales.destroy', $material->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar material?')"
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

                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                No existen materiales registrados.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection