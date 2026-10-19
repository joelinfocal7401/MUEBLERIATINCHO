@extends('layouts.admin')

@section('title', 'Ventas')
@section('page-title', 'Ventas')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Ventas
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Gestiona las ventas físicas y las compras realizadas desde la web.
            </p>
        </div>

        <a
            href="{{ route('ventas.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800"
        >
            <i data-lucide="plus" class="h-5 w-5"></i>
            Nueva venta física
        </a>

    </div>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabla de ventas --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Código
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Cliente
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Origen
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Muebles
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Pago
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

                    @forelse($ventas as $venta)

                        @php
                            $esWeb = ($venta->origen ?? '') === 'web';

                            $mueblesWeb = $venta->muebles ?? [];

                            if (is_object($mueblesWeb)) {
                                $mueblesWeb = (array) $mueblesWeb;
                            }

                            $cantidadTotal = 0;

                            if ($esWeb && is_array($mueblesWeb)) {
                                foreach ($mueblesWeb as $item) {
                                    $item = (array) $item;

                                    $cantidadTotal += (int) ($item['cantidad'] ?? 0);
                                }
                            } else {
                                $cantidadTotal = (int) ($venta->cantidad ?? 0);
                            }

                            $estado = strtolower((string) ($venta->estado ?? 'pendiente'));
                        @endphp

                        <tr class="hover:bg-gray-50">

                            {{-- Código --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="font-semibold text-gray-900">
                                    {{ $venta->codigo ?? 'Sin código' }}
                                </span>
                            </td>

                            {{-- Cliente --}}
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $venta->cliente->nombre ?? $venta->cliente->name ?? 'Cliente no disponible' }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $venta->cliente->email ?? '' }}
                                </div>
                            </td>

                            {{-- Origen --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if($esWeb)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        <i data-lucide="globe" class="h-3.5 w-3.5"></i>
                                        Compra web
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        <i data-lucide="store" class="h-3.5 w-3.5"></i>
                                        Venta física
                                    </span>
                                @endif

                            </td>

                            {{-- Muebles --}}
                            <td class="px-6 py-4">

                                @if($esWeb)

                                    @if(is_array($mueblesWeb) && count($mueblesWeb) > 0)

                                        <div class="space-y-1">

                                            @foreach($mueblesWeb as $item)

                                                @php
                                                    $item = (array) $item;
                                                @endphp

                                                <div class="text-sm text-gray-800">
                                                    {{ $item['nombre'] ?? 'Mueble' }}

                                                    <span class="text-gray-500">
                                                        × {{ $item['cantidad'] ?? 0 }}
                                                    </span>
                                                </div>

                                            @endforeach

                                            <div class="pt-1 text-xs font-medium text-gray-500">
                                                {{ $cantidadTotal }} unidad(es) en total
                                            </div>

                                        </div>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            Sin detalle de muebles
                                        </span>

                                    @endif

                                @else

                                    <div class="text-sm text-gray-800">
                                        {{ $venta->mueble->nombre ?? 'Mueble no disponible' }}
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Cantidad: {{ $venta->cantidad ?? 0 }}
                                    </div>

                                @endif

                            </td>

                            {{-- Total --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="font-semibold text-gray-900">
                                    Bs {{ number_format((float) ($venta->total ?? 0), 2) }}
                                </span>

                                @if($esWeb && (float) ($venta->saldo_pendiente ?? 0) > 0)
                                    <div class="mt-1 text-xs text-amber-600">
                                        Saldo: Bs {{ number_format((float) $venta->saldo_pendiente, 2) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Pago --}}
                            <td class="px-6 py-4">

                                <div class="text-sm text-gray-700">
                                    {{ $venta->metodo_pago ?? 'No especificado' }}
                                </div>

                                @if($esWeb)
                                    <div class="mt-1 text-xs text-gray-500">
                                        Pagado: Bs {{ number_format((float) ($venta->monto_a_pagar ?? 0), 2) }}
                                    </div>
                                @endif

                            </td>

                            {{-- Estado --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if(in_array($estado, ['pagado', 'confirmada', 'completada', 'completado']))

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ ucfirst($estado) }}
                                    </span>

                                @elseif(in_array($estado, ['cancelado', 'cancelada']))

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        {{ ucfirst($estado) }}
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                    </span>

                                @endif

                            </td>

                            {{-- Acciones --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- Ver detalle --}}
                                    <a
                                        href="{{ route('ventas.show', $venta->id) }}"
                                        title="Ver detalle"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100"
                                    >
                                        <i data-lucide="eye" class="h-5 w-5"></i>
                                    </a>

                                    {{-- Solo editar y eliminar ventas físicas --}}
                                    @if(!$esWeb)

                                        <a
                                            href="{{ route('ventas.edit', $venta->id) }}"
                                            title="Editar venta física"
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-amber-600 hover:bg-amber-100"
                                        >
                                            <i data-lucide="pencil" class="h-5 w-5"></i>
                                        </a>

                                        <form
                                            action="{{ route('ventas.destroy', $venta->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta venta física?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar venta física"
                                                class="flex h-10 w-10 items-center justify-center rounded-lg text-red-600 hover:bg-red-100"
                                            >
                                                <i data-lucide="trash-2" class="h-5 w-5"></i>
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                No existen ventas registradas.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection