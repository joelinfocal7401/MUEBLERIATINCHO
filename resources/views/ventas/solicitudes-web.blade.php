
@extends('layouts.admin')

@section('title', 'Solicitudes web')

@section('page-title', 'Solicitudes web')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Solicitudes web
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Revisa las solicitudes de muebles realizadas desde el catálogo.
        </p>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Código
                        </th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Cliente
                        </th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Muebles solicitados
                        </th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Entrega
                        </th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Total provisional
                        </th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-500">
                            Estado
                        </th>
                        <!-- ver -->
                        <th class="px-5 py-4 text-right font-semibold text-gray-500">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($solicitudes as $solicitud)

                        <tr class="align-top hover:bg-gray-50">

                            <td class="px-5 py-4 font-semibold text-gray-900">
                                {{ $solicitud->codigo ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-medium text-gray-900">
                                    {{ $solicitud->cliente->nombre ?? $solicitud->cliente->name ?? 'Cliente no encontrado' }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    {{ $solicitud->cliente->email ?? '' }}
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <div class="space-y-2">
                                    @foreach(($solicitud->muebles ?? []) as $mueble)
                                        <div>
                                            <div class="font-medium text-gray-800">
                                                {{ data_get($mueble, 'nombre', 'Mueble') }}
                                            </div>

                                            <div class="text-xs text-gray-500">
                                                Cantidad: {{ data_get($mueble, 'cantidad', 0) }}
                                                · Bs {{ number_format((float) data_get($mueble, 'subtotal', 0), 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                @if(($solicitud->tipo_entrega ?? '') === 'transporte')
                                    <div class="font-medium text-gray-800">
                                        Transporte
                                    </div>
                                    <div class="mt-1 max-w-xs text-xs text-gray-500">
                                        {{ $solicitud->direccion_entrega ?? 'Sin dirección' }}
                                    </div>
                                @else
                                    Recoger en tienda
                                @endif
                            </td>

                            <td class="px-5 py-4 font-semibold text-gray-900">
                                Bs {{ number_format((float) ($solicitud->subtotal ?? $solicitud->total ?? 0), 2) }}
                            </td>

                            <td class="px-5 py-4">
                                @if(($solicitud->estado ?? '') === 'pendiente_cotizacion')
                                    <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                        Pendiente de cotización
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        {{ str_replace('_', ' ', ucfirst($solicitud->estado ?? 'Sin estado')) }}
                                    </span>
                                @endif
                            </td>
                            <!-- ver -->
                            <td class="px-5 py-4 text-right">
                                @if(($solicitud->estado ?? '') === 'pendiente_cotizacion')
                                    <a
                                        href="{{ route('solicitudes-web.cotizar', $solicitud->solicitud_id) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800"
                                    >
                                        <i data-lucide="calculator"></i>
                                        Cotizar
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">
                                        Sin acciones
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-500">
                                Todavía no hay solicitudes web registradas.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
