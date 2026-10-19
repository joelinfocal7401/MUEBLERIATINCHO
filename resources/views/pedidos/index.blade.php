@extends('layouts.admin')

@section('title', 'Pedidos')

@section('page-title', 'Gestión de Pedidos')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                Pedidos
            </h2>

            <p class="text-sm text-gray-500">
                Administración de pedidos personalizados.
            </p>

        </div>

        <a
            href="{{ route('pedidos.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
        >
            <i data-lucide="plus"></i>
            Nuevo Pedido
        </a>

    </div>

    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Código
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Cliente
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Categoría
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Cantidad
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Entrega
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Precio
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Adelanto
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Entrega
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($pedidos as $pedido)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">

                                {{ $pedido->codigo }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $pedido->cliente->nombre ?? '-' }}

                                {{ $pedido->cliente->apellido ?? '' }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $pedido->categoria->nombre ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $pedido->cantidad }}

                            </td>

                            <td class="px-6 py-4">

                                @if($pedido->tipo_entrega == 'tienda')

                                    <span class="text-green-600 font-medium">

                                        Tienda

                                    </span>

                                @else

                                    <span class="text-blue-600 font-medium">

                                        Transporte

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                Bs.
                                {{ number_format($pedido->precio_total, 2) }}

                            </td>

                            <td class="px-6 py-4">

                                Bs.
                                {{ number_format($pedido->adelanto, 2) }}

                            </td>

                            <td class="px-6 py-4">

                                @php

                                    $color = match($pedido->estado){

                                        'pendiente_cotizacion'
                                            => 'bg-yellow-100 text-yellow-800',

                                        'cotizado'
                                            => 'bg-blue-100 text-blue-800',

                                        'pendiente_pago'
                                            => 'bg-orange-100 text-orange-800',

                                        'en_proceso'
                                            => 'bg-indigo-100 text-indigo-800',

                                        'terminado'
                                            => 'bg-green-100 text-green-800',

                                        'entregado'
                                            => 'bg-emerald-100 text-emerald-800',

                                        'cancelado'
                                            => 'bg-red-100 text-red-800',

                                        default
                                            => 'bg-gray-100 text-gray-800',
                                    };

                                @endphp

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $color }}"
                                >

                                    {{ ucfirst(str_replace('_',' ', $pedido->estado)) }}

                                </span>

                            </td>

                            <td class="px-6 py-4">

                                {{ optional($pedido->fecha_entrega)->format('d/m/Y') }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    {{-- VER --}}

                                    <a
                                        href="{{ route('pedidos.show', $pedido->id) }}"
                                        class="inline-flex items-center rounded-lg bg-sky-500 px-3 py-2 text-white hover:bg-sky-600"
                                        title="Ver"
                                    >

                                        <i data-lucide="eye"></i>

                                    </a>

                                    {{-- EDITAR --}}

                                    <a
                                        href="{{ route('pedidos.edit', $pedido->id) }}"
                                        class="inline-flex items-center rounded-lg bg-amber-500 px-3 py-2 text-white hover:bg-amber-600"
                                        title="Editar"
                                    >

                                        <i data-lucide="pencil"></i>

                                    </a>

                                    {{-- ELIMINAR --}}

                                    <form
                                        action="{{ route('pedidos.destroy', $pedido->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar pedido?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600"
                                            title="Eliminar"
                                        >

                                            <i data-lucide="trash-2"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="px-6 py-12 text-center text-gray-500"
                            >

                                No existen pedidos registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection