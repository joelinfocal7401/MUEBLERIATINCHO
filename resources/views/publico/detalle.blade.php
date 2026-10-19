
@extends('layouts.publico')

@section('title', $mueble->nombre . ' | Mueblería Tincho')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-12 md:py-16">

    {{-- Volver al catálogo --}}
    <div class="mb-8">
        <a
            href="{{ route('catalogo') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-amber-700"
        >
            <i data-phosphor-icon="arrow-left"></i>
            Volver al catálogo
        </a>
    </div>

    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:gap-16">

        {{-- Imagen del mueble --}}
        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white">

            @if($mueble->imagen)
                <img
                    src="{{ asset('storage/' . $mueble->imagen) }}"
                    alt="{{ $mueble->nombre }}"
                    class="h-80 w-full object-contain p-4 md:h-[480px]"
                >
            @else
                <div class="flex h-80 items-center justify-center text-gray-400 md:h-[480px]">
                    Imagen no disponible
                </div>
            @endif

        </div>

        {{-- Información del mueble --}}
        <div class="flex flex-col justify-center">

            <h1 class="mb-5 text-3xl font-bold text-gray-900 md:text-4xl">
                {{ $mueble->nombre }}
            </h1>

            {{-- Categoría --}}
            <p class="mb-5 text-sm text-gray-500">
                <span class="font-semibold text-gray-700">Categoría:</span>
                {{ $mueble->categoria->nombre ?? 'Sin categoría' }}
            </p>

            {{-- Descripción --}}
            <div class="mb-7">
                <h2 class="mb-2 text-lg font-semibold text-gray-900">
                    Descripción
                </h2>

                <p class="whitespace-pre-line leading-7 text-gray-600">
                    {{ $mueble->descripcion ?: 'Consulta con nosotros para conocer más detalles de este mueble.' }}
                </p>
            </div>

            {{-- Precio --}}
            <div class="mb-6">
                <p class="mb-1 text-sm text-gray-500">
                    Precio referencial por unidad
                </p>

                <p class="text-3xl font-bold text-amber-700">
                    Bs. {{ number_format((float) $mueble->precio, 2, ',', '.') }}
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    El importe final se confirmará cuando el administrador prepare tu cotización.
                </p>
            </div>

            {{-- Disponibilidad y stock --}}
            <div class="mb-7">
                @if($mueble->estado && (int) $mueble->stock > 0)
                    <span class="inline-flex items-center gap-2 rounded-full bg-green-50 px-4 py-2 text-sm font-medium text-green-700">
                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                        Disponible
                    </span>

                    <p class="mt-2 text-sm text-gray-500">
                        Unidades disponibles: {{ $mueble->stock }}
                    </p>
                @else
                    <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 text-sm font-medium text-gray-600">
                        <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                        Agotado
                    </span>

                    <p class="mt-2 text-sm text-gray-500">
                        Actualmente no hay unidades disponibles de este mueble.
                    </p>
                @endif
            </div>

            {{-- Mensajes de validación --}}
            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Acciones --}}
            @if($mueble->estado && (int) $mueble->stock > 0)

                @auth

                    {{-- Agregar mueble al carrito --}}
                    <form
                        action="{{ route('compra.agregar', $mueble->id) }}"
                        method="POST"
                        class="space-y-4"
                    >
                        @csrf

                        <div>
                            <label
                                for="cantidad"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Selecciona la cantidad
                            </label>

                            <input
                                type="number"
                                id="cantidad"
                                name="cantidad"
                                min="1"
                                max="{{ min(4, (int) $mueble->stock) }}"
                                value="{{ old('cantidad', 1) }}"
                                required
                                class="w-full max-w-xs rounded-xl border-gray-300 focus:border-amber-600 focus:ring-amber-600"
                            >

                            <p class="mt-2 text-xs text-gray-500">
                                Máximo 4 unidades por mueble, sujeto al stock disponible.
                            </p>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-amber-700 px-7 py-3.5 font-semibold text-white transition hover:bg-amber-800 sm:w-fit"
                        >
                            <i data-phosphor-icon="shopping-cart"></i>
                            Agregar a mi solicitud
                        </button>
                    </form>

                    <a
                        href="{{ route('compra.carrito') }}"
                        class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-amber-700"
                    >
                        Ver mi solicitud
                        <i data-phosphor-icon="arrow-right"></i>
                    </a>

                @else

                    <p class="mb-4 text-sm text-gray-600">
                        Inicia sesión para agregar muebles a tu solicitud de compra.
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-amber-700 px-7 py-3.5 font-semibold text-white transition hover:bg-amber-800 sm:w-fit"
                    >
                        Iniciar sesión para continuar
                    </a>

                @endauth

            @else

                <button
                    type="button"
                    disabled
                    class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl bg-gray-200 px-7 py-3.5 font-semibold text-gray-500 sm:w-fit"
                >
                    Agotado
                </button>

            @endif

            {{-- Separar compra de muebles existentes y personalizados --}}
            <div class="mt-8 border-t border-gray-100 pt-6">
                <p class="mb-3 text-sm text-gray-600">
                    ¿Necesitas un mueble con medidas, colores o características específicas?
                </p>

                <a
                    href="{{ route('contacto') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-amber-700 transition hover:text-amber-800"
                >
                    Consultar por un mueble personalizado
                    <i data-phosphor-icon="arrow-right"></i>
                </a>
            </div>

        </div>

    </div>

</section>

@endsection
