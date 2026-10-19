@extends('layouts.admin')

@section('title', 'Detalle Venta')

@section('page-title', 'Detalle Venta')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('ventas.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900"
        >
            <i data-lucide="arrow-left"></i>
            Volver
        </a>

        <h1 class="mt-3 text-3xl font-bold text-gray-900">
            Detalle de Venta
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Información completa de la venta registrada.
        </p>

    </div>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">

        <div class="border-b border-gray-200 bg-gray-50 px-6 py-5">

            <h2 class="text-xl font-bold text-gray-900">
                {{ $venta->codigo }}
            </h2>

        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Código
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->codigo }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Cliente
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->cliente->nombre ?? '-' }}
                    {{ $venta->cliente->apellido ?? '' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Mueble
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->mueble->nombre ?? '-' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Cantidad
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->cantidad }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Precio Unitario
                </label>

                <p class="mt-1 text-gray-900">
                    Bs {{ number_format($venta->precio_unitario, 2) }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Total
                </label>

                <p class="mt-1 text-gray-900 font-bold">
                    Bs {{ number_format($venta->total, 2) }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Método de Pago
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->metodo_pago }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Estado
                </label>

                <div class="mt-2">

                    @if($venta->estado == 'Pagado')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Pagado
                        </span>

                    @else

                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                            Pendiente
                        </span>

                    @endif

                </div>

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">
                    Fecha Registro
                </label>

                <p class="mt-1 text-gray-900">
                    {{ $venta->created_at?->format('d/m/Y H:i') }}
                </p>
            </div>

        </div>

        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('ventas.edit', $venta->id) }}"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800"
                >
                    Editar
                </a>

                <a
                    href="{{ route('ventas.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Volver
                </a>

            </div>

        </div>

    </div>

</div>

@endsection