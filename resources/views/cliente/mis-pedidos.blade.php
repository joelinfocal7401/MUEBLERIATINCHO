
@extends('layouts.cliente')

@section('title', 'Mis pedidos')

@section('content')

@if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        {{ session('error') }}
    </div>
@endif

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Encabezado --}}
    <div>
        <p class="text-sm font-medium text-blue-600">Mi cuenta / Compras</p>
        <h1 class="mt-1 text-2xl font-bold text-slate-800">
            Mis pedidos y cotizaciones
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Consulta tus solicitudes, cotizaciones y el estado de tus compras.
        </p>
    </div>

    {{-- Resumen --}}
    @php
        $totalSolicitudes = $solicitudes->count();
        $pendientes = $solicitudes->where('estado', 'pendiente_cotizacion')->count();
        $cotizadas = $solicitudes->where('estado', 'cotizado')->count();
    @endphp

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total de solicitudes</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">
                {{ $totalSolicitudes }}
            </p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Pendientes de cotización</p>
            <p class="mt-2 text-3xl font-bold text-amber-600">
                {{ $pendientes }}
            </p>
        </div>

        <div class="rounded-xl border border-blue-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Cotizaciones recibidas</p>
            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ $cotizadas }}
            </p>
        </div>
    </div>

    {{-- Historial --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-5 py-4">
            <h2 class="font-semibold text-slate-800">Historial de solicitudes</h2>
        </div>

        @if($solicitudes->isEmpty())

            <div class="px-6 py-14 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                    </svg>
                </div>

                <h3 class="mt-4 text-lg font-semibold text-slate-800">
                    Aún no tienes solicitudes
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Cuando solicites una cotización desde nuestro catálogo,
                    podrás consultar aquí su estado y los detalles.
                </p>

                <a href="{{ route('catalogo') }}"
                   class="mt-6 inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Explorar muebles
                </a>
            </div>

        @else

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">

                    <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Solicitud</th>
                            <th class="px-5 py-4">Muebles</th>
                            <th class="px-5 py-4">Entrega</th>
                            <th class="px-5 py-4">Importe</th>
                            <th class="px-5 py-4">Estado y acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($solicitudes as $solicitud)

                            @php
                                $estado = $solicitud->estado ?? 'pendiente_cotizacion';

                                $estados = [
                                    'pendiente_cotizacion' => [
                                        'texto' => 'Pendiente de cotización',
                                        'clase' => 'bg-amber-100 text-amber-700',
                                    ],
                                    'cotizado' => [
                                        'texto' => 'Cotización disponible',
                                        'clase' => 'bg-blue-100 text-blue-700',
                                    ],
                                    'aceptado' => [
                                        'texto' => 'Cotización aceptada',
                                        'clase' => 'bg-indigo-100 text-indigo-700',
                                    ],
                                    'pendiente_pago' => [
                                        'texto' => 'Pendiente de pago',
                                        'clase' => 'bg-orange-100 text-orange-700',
                                    ],
                                    'pago_notificado' => [
                                        'texto' => 'Pago por verificar',
                                        'clase' => 'bg-purple-100 text-purple-700',
                                    ],
                                    'pago_confirmado' => [
                                        'texto' => 'Pago confirmado',
                                        'clase' => 'bg-green-100 text-green-700',
                                    ],
                                    'cancelado' => [
                                        'texto' => 'Cancelado',
                                        'clase' => 'bg-red-100 text-red-700',
                                    ],
                                ];

                                $infoEstado = $estados[$estado] ?? [
                                    'texto' => ucfirst(str_replace('_', ' ', $estado)),
                                    'clase' => 'bg-slate-100 text-slate-700',
                                ];

                                $solicitudId = (string) ($solicitud->solicitud_id ?? '');
                            @endphp

                            <tr class="align-top transition hover:bg-slate-50">

                                {{-- Código y fecha --}}
                                <td class="whitespace-nowrap px-5 py-5">
                                    <p class="font-semibold text-slate-800">
                                        {{ $solicitud->codigo ?? 'Sin código' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        @if(!empty($solicitud->created_at))
                                            {{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y H:i') }}
                                        @else
                                            Fecha no disponible
                                        @endif
                                    </p>
                                </td>

                                {{-- Muebles --}}
                                <td class="px-5 py-5">
                                    <div class="min-w-48 space-y-2">
                                        @foreach(($solicitud->muebles ?? []) as $mueble)
                                            <div>
                                                <p class="font-medium text-slate-700">
                                                    {{ $mueble['nombre'] ?? 'Mueble' }}
                                                </p>
                                                <p class="text-xs text-slate-500">
                                                    Cantidad: {{ $mueble['cantidad'] ?? 0 }}
                                                    · Subtotal: Bs {{ number_format((float) ($mueble['subtotal'] ?? 0), 2) }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                {{-- Entrega --}}
                                <td class="px-5 py-5 text-slate-600">
                                    @if(($solicitud->tipo_entrega ?? '') === 'transporte')
                                        <p class="font-medium text-slate-700">Con transporte</p>
                                        <p class="mt-1 max-w-48 whitespace-normal text-xs text-slate-500">
                                            {{ $solicitud->direccion_entrega ?? 'Dirección pendiente' }}
                                        </p>
                                    @else
                                        <span class="whitespace-nowrap">Recojo en tienda</span>
                                    @endif
                                </td>

                                {{-- Total --}}
                                <td class="whitespace-nowrap px-5 py-5">
                                    <p class="font-semibold text-slate-800">
                                        Bs {{ number_format((float) ($solicitud->total ?? 0), 2) }}
                                    </p>

                                    @if($estado === 'cotizado')
                                        <p class="mt-1 text-xs text-blue-600">Cotización lista</p>
                                    @elseif($estado === 'pendiente_pago')
                                        <p class="mt-1 text-xs text-slate-500">
                                            A pagar: Bs {{ number_format((float) ($solicitud->monto_a_pagar ?? 0), 2) }}
                                        </p>
                                    @elseif($estado === 'pago_notificado')
                                        <p class="mt-1 text-xs text-slate-500">
                                            Pago notificado
                                        </p>
                                    @endif
                                </td>

                                {{-- Estado y botones --}}
                                <td class="px-5 py-5">
                                    <span class="inline-flex whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold {{ $infoEstado['clase'] }}">
                                        {{ $infoEstado['texto'] }}
                                    </span>

                                    @if($estado === 'pendiente_cotizacion')
                                        <p class="mt-2 max-w-48 text-xs text-slate-500">
                                            Estamos preparando tu cotización.
                                        </p>
                                    @elseif($estado === 'cotizado')
                                        <p class="mt-2 max-w-48 text-xs text-slate-500">
                                            Ya puedes revisar el precio cotizado.
                                        </p>
                                    @elseif($estado === 'pendiente_pago')
                                        <p class="mt-2 max-w-48 text-xs text-slate-500">
                                            Puedes abrir el QR para continuar con tu pago.
                                        </p>
                                    @elseif($estado === 'pago_notificado')
                                        <p class="mt-2 max-w-48 text-xs text-slate-500">
                                            El administrador debe verificar tu pago.
                                        </p>
                                    @endif

                                    @if($estado === 'cotizado')
                                        <button
                                            type="button"
                                            onclick="document.getElementById('modal-cotizacion-{{ $solicitudId }}').classList.remove('hidden')"
                                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >
                                            Ver cotización
                                        </button>
                                    @endif

                                    @if($estado === 'pendiente_pago')
                                        <button
                                            type="button"
                                            onclick="document.getElementById('modal-pago-{{ $solicitudId }}').classList.remove('hidden')"
                                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >
                                            <i data-lucide="qr-code" class="h-4 w-4"></i>
                                            Ver QR de pago
                                        </button>
                                    @endif
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-5 py-4">
                <a href="{{ route('catalogo') }}"
                   class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                    + Solicitar otra cotización
                </a>
            </div>

        @endif
    </div>
</div>

{{-- =========================================================
     MODALES FUERA DE LA TABLA
     Así evitamos colocar elementos div directamente dentro
     de tbody, lo que puede provocar problemas de estructura HTML.
========================================================= --}}

@foreach($solicitudes as $solicitud)

    @php
        $estado = $solicitud->estado ?? 'pendiente_cotizacion';
        $solicitudId = (string) ($solicitud->solicitud_id ?? '');
        $abrirQr = $estado === 'pendiente_pago'
            && (string) session('abrir_pago', '') === $solicitudId;
    @endphp

    {{-- Modal de cotización --}}
    @if($estado === 'cotizado')
        <div
            id="modal-cotizacion-{{ $solicitudId }}"
            class="fixed inset-0 z-50 hidden overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-labelledby="titulo-cotizacion-{{ $solicitudId }}"
        >
            <div
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
                onclick="document.getElementById('modal-cotizacion-{{ $solicitudId }}').classList.add('hidden')"
            ></div>

            <div class="relative flex min-h-full items-center justify-center p-4">
                <div class="relative w-full max-w-2xl rounded-2xl bg-white shadow-2xl">

                    {{-- Encabezado con X --}}
                    <div class="flex items-start justify-between border-b border-slate-200 p-5">
                        <div>
                            <p class="text-sm font-medium text-blue-600">
                                Solicitud {{ $solicitud->codigo ?? '' }}
                            </p>
                            <h2 id="titulo-cotizacion-{{ $solicitudId }}"
                                class="mt-1 text-xl font-bold text-slate-800">
                                Tu cotización está lista
                            </h2>
                        </div>

                        <button
                            type="button"
                            onclick="document.getElementById('modal-cotizacion-{{ $solicitudId }}').classList.add('hidden')"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
                            aria-label="Cerrar cotización"
                            title="Cerrar"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="max-h-[70vh] space-y-5 overflow-y-auto p-5">

                        {{-- Productos --}}
                        @foreach(($solicitud->muebles ?? []) as $mueble)
                            <div class="flex flex-col gap-4 rounded-xl border border-slate-200 p-4 sm:flex-row">

                                @if(!empty($mueble['imagen_url']))
                                    <img
                                        src="{{ $mueble['imagen_url'] }}"
                                        alt="{{ $mueble['nombre'] ?? 'Mueble' }}"
                                        class="h-40 w-full rounded-lg object-cover sm:w-44"
                                    >
                                @else
                                    <div class="flex h-40 w-full items-center justify-center rounded-lg bg-slate-100 text-sm text-slate-500 sm:w-44">
                                        Imagen no disponible
                                    </div>
                                @endif

                                <div class="flex-1 space-y-2">
                                    <h3 class="font-semibold text-slate-800">
                                        {{ $mueble['nombre'] ?? 'Mueble' }}
                                    </h3>
                                    <p class="text-sm text-slate-500">
                                        Cantidad: {{ $mueble['cantidad'] ?? 0 }}
                                    </p>
                                    <p class="text-sm text-slate-600">
                                        Precio unitario: Bs {{ number_format((float) ($mueble['precio_unitario'] ?? 0), 2) }}
                                    </p>
                                    <p class="font-semibold text-slate-800">
                                        Subtotal: Bs {{ number_format((float) ($mueble['subtotal'] ?? 0), 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Entrega y detalles --}}
                        <div class="space-y-3 rounded-xl bg-slate-50 p-4">
                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Tipo de entrega</span>
                                <span class="text-right font-medium text-slate-800">
                                    {{ ($solicitud->tipo_entrega ?? '') === 'transporte' ? 'Con transporte' : 'Recojo en tienda' }}
                                </span>
                            </div>

                            @if(($solicitud->tipo_entrega ?? '') === 'transporte')
                                <div class="flex justify-between gap-4 text-sm">
                                    <span class="text-slate-500">Dirección</span>
                                    <span class="text-right text-slate-800">
                                        {{ $solicitud->direccion_entrega ?? 'No especificada' }}
                                    </span>
                                </div>
                            @endif

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Transporte</span>
                                <span class="font-medium text-slate-800">
                                    Bs {{ number_format((float) ($solicitud->costo_transporte ?? 0), 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Fecha de entrega</span>
                                <span class="font-medium text-slate-800">
                                    @if(!empty($solicitud->fecha_entrega))
                                        {{ \Carbon\Carbon::parse($solicitud->fecha_entrega)->format('d/m/Y') }}
                                    @else
                                        Por confirmar
                                    @endif
                                </span>
                            </div>

                            @if(!empty($solicitud->observaciones))
                                <div class="border-t border-slate-200 pt-3 text-sm">
                                    <p class="text-slate-500">Observaciones</p>
                                    <p class="mt-1 text-slate-700">
                                        {{ $solicitud->observaciones }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- Total --}}
                        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="font-semibold text-slate-700">Total cotizado</span>
                                <span class="text-2xl font-bold text-blue-700">
                                    Bs {{ number_format((float) ($solicitud->total ?? 0), 2) }}
                                </span>
                            </div>
                        </div>

                        {{-- Selección del pago --}}
                        <form
                            method="POST"
                            action="{{ route('cliente.cotizacion.aceptar', $solicitudId) }}"
                            class="space-y-3"
                        >
                            @csrf

                            <h3 class="font-semibold text-slate-800">
                                Elige cómo deseas pagar
                            </h3>

                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 hover:border-blue-400">
                                <input type="radio" name="tipo_pago" value="adelanto" required class="h-4 w-4">

                                <span class="flex-1">
                                    <span class="block font-semibold text-slate-800">
                                        Adelanto del 50 %
                                    </span>
                                    <span class="text-sm text-slate-500">
                                        Para iniciar tu compra
                                    </span>
                                </span>

                                <span class="font-bold text-slate-800">
                                    Bs {{ number_format((float) ($solicitud->adelanto ?? ((float) ($solicitud->total ?? 0) * 0.5)), 2) }}
                                </span>
                            </label>

                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 hover:border-blue-400">
                                <input type="radio" name="tipo_pago" value="total" required class="h-4 w-4">

                                <span class="flex-1">
                                    <span class="block font-semibold text-slate-800">
                                        Pago total
                                    </span>
                                    <span class="text-sm text-slate-500">
                                        Pagar el importe completo
                                    </span>
                                </span>

                                <span class="font-bold text-slate-800">
                                    Bs {{ number_format((float) ($solicitud->total ?? 0), 2) }}
                                </span>
                            </label>

                            <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end">
                                <button
                                    type="button"
                                    onclick="document.getElementById('modal-cotizacion-{{ $solicitudId }}').classList.add('hidden')"
                                    class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                                >
                                    Cerrar
                                </button>

                                <button
                                    type="submit"
                                    class="rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700"
                                >
                                    Aceptar cotización
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal QR: disponible mientras siga pendiente de pago --}}
    @if($estado === 'pendiente_pago')
        <div
            id="modal-pago-{{ $solicitudId }}"
            class="fixed inset-0 z-[60] {{ $abrirQr ? '' : 'hidden' }} overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-labelledby="titulo-pago-{{ $solicitudId }}"
        >
            <div
                class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm"
                onclick="document.getElementById('modal-pago-{{ $solicitudId }}').classList.add('hidden')"
            ></div>

            <div class="relative flex min-h-full items-center justify-center p-4">
                <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl">

                    {{-- Encabezado QR con X --}}
                    <div class="relative text-center">
                        <button
                            type="button"
                            onclick="document.getElementById('modal-pago-{{ $solicitudId }}').classList.add('hidden')"
                            class="absolute -right-2 -top-2 flex h-9 w-9 items-center justify-center rounded-full text-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
                            aria-label="Cerrar ventana de pago"
                            title="Cerrar"
                        >
                            &times;
                        </button>

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-700">
                            <i data-lucide="qr-code" class="h-7 w-7"></i>
                        </div>

                        <h2 id="titulo-pago-{{ $solicitudId }}"
                            class="mt-4 text-2xl font-bold text-slate-800">
                            Realiza tu pago
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Escanea el código QR desde la aplicación de tu banco.
                        </p>
                    </div>

                    {{-- Imagen QR --}}
                    <div class="my-5 rounded-xl border border-slate-200 bg-white p-3">
                        <img
                            src="{{ asset('images/pagos/qr-tincho..jpeg') }}"
                            alt="Código QR de pago de Mueblería Tincho"
                            class="mx-auto max-h-80 w-full object-contain"
                        >
                    </div>

                    {{-- Importe seleccionado --}}
                    <div class="rounded-xl bg-blue-50 p-4 text-center">
                        <p class="text-sm text-slate-600">Monto que debes pagar</p>

                        <p class="mt-1 text-3xl font-bold text-blue-700">
                            Bs {{ number_format((float) ($solicitud->monto_a_pagar ?? 0), 2) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ ($solicitud->tipo_pago ?? '') === 'total'
                                ? 'Pago del importe total'
                                : 'Pago del adelanto del 50 %' }}
                        </p>
                    </div>

                    <p class="mt-4 text-sm leading-5 text-slate-600">
                        Después de realizar la transferencia, pulsa
                        <strong>Ya realicé el pago</strong>. El administrador
                        verificará manualmente el pago antes de confirmar tu compra.
                    </p>

                    <div class="mt-6 space-y-3">

                        {{-- Notificar pago --}}
                        <form
                            method="POST"
                            action="{{ route('cliente.pago.notificar', $solicitudId) }}"
                            onsubmit="return confirm('¿Confirmas que ya realizaste la transferencia?');"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 font-semibold text-white transition hover:bg-emerald-700"
                            >
                                <i data-lucide="check-circle" class="h-5 w-5"></i>
                                Ya realicé el pago
                            </button>
                        </form>

                        {{-- Cancelar compra: acción independiente de la X --}}
                        <form
                            method="POST"
                            action="{{ route('cliente.pago.cancelar', $solicitudId) }}"
                            onsubmit="return confirm('¿Deseas cancelar esta compra? No se descontará stock.');"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="w-full rounded-xl border border-red-200 px-5 py-3 font-semibold text-red-600 transition hover:bg-red-50"
                            >
                                Cancelar compra
                            </button>
                        </form>
                    </div>

                    <p class="mt-4 text-center text-xs text-slate-400">
                        Solicitud: {{ $solicitud->codigo ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    @endif

@endforeach

@endsection
