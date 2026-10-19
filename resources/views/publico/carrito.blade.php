
@extends('layouts.publico')

@section('title', 'Mi solicitud | Mueblería Tincho')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-14">

    <div class="mb-8">
        <a href="{{ route('catalogo') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-amber-700">
            <i data-phosphor-icon="arrow-left"></i>
            Volver al catálogo
        </a>

        <h1 class="mt-5 text-3xl md:text-4xl font-bold text-gray-900">
            Mi solicitud de compra
        </h1>

        <p class="mt-2 text-gray-500">
            Revisa tus muebles y solicita una cotización personalizada.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(empty($carrito))
        <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                <i data-phosphor-icon="shopping-cart" class="text-3xl text-gray-500"></i>
            </div>

            <h2 class="text-xl font-semibold text-gray-900">
                Tu solicitud está vacía
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Explora nuestro catálogo y agrega los muebles que te interesan.
            </p>

            <a href="{{ route('catalogo') }}"
               class="mt-6 inline-flex items-center justify-center rounded-xl bg-amber-700 px-6 py-3 text-sm font-semibold text-white hover:bg-amber-800">
                Explorar catálogo
            </a>
        </div>
    @else

        @php
            $subtotal = collect($carrito)->sum(
                fn ($item) => (float) $item['precio'] * (int) $item['cantidad']
            );
        @endphp

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- Lista de muebles --}}
            <div class="space-y-4 lg:col-span-2">

                @foreach($carrito as $id => $item)
                    <article class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-6">

                        <div class="flex flex-col gap-5 sm:flex-row">

                            <div class="flex h-36 w-full items-center justify-center overflow-hidden rounded-xl bg-gray-50 sm:w-36 sm:shrink-0">
                                @if(!empty($item['imagen']))
                                    <img
                                        src="{{ asset('storage/' . $item['imagen']) }}"
                                        alt="{{ $item['nombre'] }}"
                                        class="h-full w-full object-contain p-2"
                                    >
                                @else
                                    <i data-phosphor-icon="armchair" class="text-4xl text-gray-300"></i>
                                @endif
                            </div>

                            <div class="flex flex-1 flex-col justify-between gap-4">

                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">
                                        {{ $item['nombre'] }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Precio referencial:
                                        Bs {{ number_format((float) $item['precio'], 2, ',', '.') }}
                                    </p>

                                    <p class="mt-2 text-sm font-semibold text-amber-700">
                                        Subtotal:
                                        Bs {{ number_format((float) $item['precio'] * (int) $item['cantidad'], 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-3">

                                    <form
                                        action="{{ route('compra.actualizar', $id) }}"
                                        method="POST"
                                        class="flex items-center gap-2"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <label for="cantidad-{{ $id }}"
                                               class="text-sm text-gray-600">
                                            Cantidad
                                        </label>

                                        <input
                                            id="cantidad-{{ $id }}"
                                            type="number"
                                            name="cantidad"
                                            min="1"
                                            max="4"
                                            value="{{ $item['cantidad'] }}"
                                            required
                                            class="w-20 rounded-lg border-gray-300 text-sm"
                                        >

                                        <button
                                            type="submit"
                                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                        >
                                            Actualizar
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('compra.eliminar', $id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Retirar este mueble de tu solicitud?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50"
                                        >
                                            <i data-phosphor-icon="trash"></i>
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>

            {{-- Resumen y entrega --}}
            <aside class="h-fit rounded-2xl border border-gray-200 bg-white p-6">

                <h2 class="text-xl font-semibold text-gray-900">
                    Resumen de solicitud
                </h2>

                <div class="mt-5 flex items-center justify-between gap-3 text-sm text-gray-600">
                    <span>Muebles seleccionados</span>
                    <span class="font-medium text-gray-900">
                        {{ count($carrito) }}
                    </span>
                </div>

                <div class="mt-3 flex items-center justify-between gap-3">
                    <span class="text-sm text-gray-600">Subtotal referencial</span>
                    <span class="font-semibold text-gray-900">
                        Bs {{ number_format($subtotal, 2, ',', '.') }}
                    </span>
                </div>

                <p class="mt-4 text-xs leading-5 text-gray-500">
                    El precio final se confirmará en la cotización. Si solicitas transporte,
                    el administrador añadirá su costo antes de que realices el pago.
                </p>

                <div class="my-6 border-t border-gray-100"></div>

                <form
                    action="{{ route('compra.solicitar') }}"
                    method="POST"
                    class="space-y-5"
                >
                    @csrf

                    <div>
                        <label for="tipo_entrega"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            ¿Cómo deseas recibir tu compra?
                        </label>

                        <select
                            id="tipo_entrega"
                            name="tipo_entrega"
                            required
                            class="w-full rounded-xl border-gray-300"
                        >
                            <option value="tienda"
                                {{ old('tipo_entrega', 'tienda') === 'tienda' ? 'selected' : '' }}>
                                Recoger en tienda
                            </option>

                            <option value="transporte"
                                {{ old('tipo_entrega') === 'transporte' ? 'selected' : '' }}>
                                Solicitar transporte
                            </option>
                        </select>
                    </div>

                    <div id="campo-direccion"
                         class="{{ old('tipo_entrega') === 'transporte' ? '' : 'hidden' }}">

                        <label for="direccion_entrega"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Dirección de entrega
                        </label>

                        <textarea
                            id="direccion_entrega"
                            name="direccion_entrega"
                            rows="3"
                            maxlength="500"
                            placeholder="Zona, calle, número y referencias"
                            class="w-full rounded-xl border-gray-300"
                        >{{ old('direccion_entrega') }}</textarea>

                        <p class="mt-1 text-xs text-gray-500">
                            El costo del transporte se añadirá a la cotización.
                        </p>
                    </div>

                    @auth
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-amber-700 px-5 py-3.5 text-sm font-semibold text-white hover:bg-amber-800"
                        >
                            Solicitar cotización
                            <i data-phosphor-icon="arrow-right"></i>
                        </button>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="flex w-full items-center justify-center rounded-xl bg-amber-700 px-5 py-3.5 text-sm font-semibold text-white hover:bg-amber-800"
                        >
                            Iniciar sesión para continuar
                        </a>
                    @endauth

                </form>
            </aside>

        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoEntrega = document.getElementById('tipo_entrega');
        const campoDireccion = document.getElementById('campo-direccion');
        const direccion = document.getElementById('direccion_entrega');

        if (!tipoEntrega || !campoDireccion || !direccion) {
            return;
        }

        function actualizarEntrega() {
            const usaTransporte = tipoEntrega.value === 'transporte';

            campoDireccion.classList.toggle('hidden', !usaTransporte);
            direccion.required = usaTransporte;

            if (!usaTransporte) {
                direccion.value = '';
            }
        }

        tipoEntrega.addEventListener('change', actualizarEntrega);
        actualizarEntrega();
    });
</script>
@endsection
