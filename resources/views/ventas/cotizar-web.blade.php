
@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-5xl space-y-6 p-4 md:p-6">

    {{-- Encabezado --}}
    <div>
        <a href="{{ route('solicitudes-web.index') }}"
           class="text-sm font-medium text-blue-600 hover:text-blue-800">
            ← Volver a solicitudes web
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">
            Cotizar solicitud web
        </h1>

        <p class="mt-1 text-slate-500">
            Código: <strong>{{ $solicitud->codigo ?? 'Sin código' }}</strong>
        </p>
    </div>

    {{-- Mensajes --}}
    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="font-semibold">Revisa los siguientes datos:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Cliente y entrega --}}
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
        <h2 class="mb-4 text-lg font-semibold text-slate-800">
            Datos de la solicitud
        </h2>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <p class="text-sm text-slate-500">Cliente</p>
                <p class="mt-1 font-medium text-slate-800">
                    {{ $cliente->name ?? 'Cliente no encontrado' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Tipo de entrega</p>
                <p class="mt-1 font-medium text-slate-800">
                    {{ ($solicitud->tipo_entrega ?? '') === 'transporte'
                        ? 'Entrega con transporte'
                        : 'Recojo en tienda' }}
                </p>
            </div>

            @if(($solicitud->tipo_entrega ?? '') === 'transporte')
                <div class="sm:col-span-2">
                    <p class="text-sm text-slate-500">Dirección de entrega</p>
                    <p class="mt-1 text-slate-800">
                        {{ $solicitud->direccion_entrega ?? 'Dirección no registrada' }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- Muebles solicitados --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-5">
            <h2 class="text-lg font-semibold text-slate-800">
                Muebles solicitados
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Mueble</th>
                        <th class="px-5 py-3">Cantidad</th>
                        <th class="px-5 py-3">Precio unitario</th>
                        <th class="px-5 py-3">Subtotal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach(($solicitud->muebles ?? []) as $mueble)
                        <tr>
                            <td class="px-5 py-4 font-medium text-slate-800">
                                {{ data_get($mueble, 'nombre', 'Mueble') }}
                            </td>
                            <td class="px-5 py-4">
                                {{ data_get($mueble, 'cantidad', 0) }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                Bs {{ number_format((float) data_get($mueble, 'precio_unitario', 0), 2) }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 font-medium">
                                Bs {{ number_format((float) data_get($mueble, 'subtotal', 0), 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 bg-slate-50 px-5 py-4 text-right">
            <span class="text-slate-500">Subtotal de muebles:</span>
            <strong class="ml-2 text-lg text-slate-800">
                Bs {{ number_format((float) ($solicitud->subtotal ?? 0), 2) }}
            </strong>
        </div>
    </div>

    {{-- Formulario de cotización --}}
    <form
        action="{{ route('solicitudes-web.guardar-cotizacion', request()->route('id')) }}"
        method="POST"
        class="space-y-6"
    >
        @csrf

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
            <h2 class="text-lg font-semibold text-slate-800">
                Datos de la cotización
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Define el transporte, la fecha de entrega y las observaciones.
            </p>

            <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Transporte --}}
                <div>
                    <label for="costo_transporte"
                           class="mb-2 block text-sm font-medium text-slate-700">
                        Costo de transporte (Bs)
                    </label>

                    @if(($solicitud->tipo_entrega ?? '') === 'transporte')
                        <input
                            type="number"
                            name="costo_transporte"
                            id="costo_transporte"
                            min="0"
                            step="0.01"
                            value="{{ old('costo_transporte', 0) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        >
                        <p class="mt-1 text-xs text-slate-500">
                            Introduce el costo de llevar los muebles a la dirección del cliente.
                        </p>
                    @else
                        <input
                            type="number"
                            name="costo_transporte"
                            id="costo_transporte"
                            value="0"
                            min="0"
                            step="0.01"
                            readonly
                            class="w-full rounded-lg border border-slate-200 bg-slate-100 p-3 text-slate-600"
                        >
                        <p class="mt-1 text-xs text-slate-500">
                            El cliente recogerá sus muebles en la tienda. El transporte es Bs 0.
                        </p>
                    @endif

                    @error('costo_transporte')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fecha --}}
                <div>
                    <label for="fecha_entrega"
                           class="mb-2 block text-sm font-medium text-slate-700">
                        Fecha de entrega
                    </label>

                    <input
                        type="date"
                        name="fecha_entrega"
                        id="fecha_entrega"
                        min="{{ now()->format('Y-m-d') }}"
                        value="{{ old('fecha_entrega') }}"
                        required
                        class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >

                    @error('fecha_entrega')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Observaciones --}}
                <div class="md:col-span-2">
                    <label for="observaciones"
                           class="mb-2 block text-sm font-medium text-slate-700">
                        Observaciones (opcional)
                    </label>

                    <textarea
                        name="observaciones"
                        id="observaciones"
                        rows="3"
                        maxlength="1000"
                        class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Detalles adicionales para el cliente..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Resumen económico --}}
        <div class="rounded-xl border border-blue-100 bg-white p-5 shadow-sm md:p-6">
            <h2 class="text-lg font-semibold text-slate-800">
                Resumen económico
            </h2>

            <div class="mt-5 space-y-4">
                <div class="flex items-center justify-between gap-4 text-sm">
                    <span class="text-slate-500">Subtotal de muebles</span>
                    <span class="font-medium text-slate-800">
                        Bs {{ number_format((float) ($solicitud->subtotal ?? 0), 2) }}
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4 text-sm">
                    <span class="text-slate-500">Transporte</span>
                    <span id="resumen_transporte" class="font-medium text-slate-800">
                        Bs 0.00
                    </span>
                </div>

                <div class="border-t border-slate-200 pt-4">
                    <div class="flex items-center justify-between gap-4">
                        <span class="font-semibold text-slate-700">Total de la cotización</span>
                        <span id="total" class="text-xl font-bold text-slate-900">
                            Bs 0.00
                        </span>
                    </div>
                </div>

                <div class="rounded-lg bg-blue-50 p-4">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-sm font-medium text-blue-800">
                            Adelanto del 50 %
                        </span>
                        <span id="adelanto" class="text-lg font-bold text-blue-800">
                            Bs 0.00
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-blue-700">
                        Este importe se calculará como adelanto solicitado al cliente.
                    </p>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-sm text-slate-500">Saldo restante después del adelanto</span>
                    <span id="saldo" class="font-semibold text-slate-800">
                        Bs 0.00
                    </span>
                </div>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="flex flex-wrap gap-3">
            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700"
            >
                Guardar cotización
            </button>

            <a
                href="{{ route('solicitudes-web.index') }}"
                class="rounded-lg border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 hover:bg-slate-50"
            >
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const subtotal = Number(@json((float) ($solicitud->subtotal ?? 0)));
    const transporte = document.getElementById('costo_transporte');
    const resumenTransporte = document.getElementById('resumen_transporte');
    const total = document.getElementById('total');
    const adelanto = document.getElementById('adelanto');
    const saldo = document.getElementById('saldo');

    function dinero(valor) {
        return 'Bs ' + valor.toFixed(2);
    }

    function calcularCotizacion() {
        const costoTransporte = Math.max(0, Number(transporte.value) || 0);
        const precioTotal = subtotal + costoTransporte;
        const montoAdelanto = Math.round((precioTotal * 0.5 + Number.EPSILON) * 100) / 100;
        const montoSaldo = Math.round((precioTotal - montoAdelanto + Number.EPSILON) * 100) / 100;

        resumenTransporte.textContent = dinero(costoTransporte);
        total.textContent = dinero(precioTotal);
        adelanto.textContent = dinero(montoAdelanto);
        saldo.textContent = dinero(montoSaldo);
    }

    transporte.addEventListener('input', calcularCotizacion);
    calcularCotizacion();
});
</script>
@endsection
