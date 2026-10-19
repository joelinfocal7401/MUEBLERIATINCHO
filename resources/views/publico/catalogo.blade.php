@extends('layouts.publico')

@section('title', 'Catálogo de muebles | Mueblería Tincho')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-12 md:py-16">

    {{-- Encabezado --}}
    <div class="mb-10">
        <p class="text-sm font-semibold uppercase tracking-widest text-amber-700 mb-3">
            Nuestros trabajos
        </p>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Catálogo de <span class="italic text-amber-700">muebles</span>
        </h1>

        <p class="max-w-2xl text-gray-600 leading-7">
            Conoce nuestros muebles fabricados en melamina y encuentra
            el diseño ideal para tu espacio.
        </p>
    </div>

    {{-- Buscador y filtro --}}
    <form action="{{ route('catalogo') }}"
          method="GET"
          class="mb-10 grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2">
            <label for="buscar"
                   class="block text-sm font-medium text-gray-700 mb-2">
                Buscar muebles
            </label>

            <input
                type="search"
                id="buscar"
                name="buscar"
                value="{{ $buscar }}"
                placeholder="Ej. escritorio, ropero..."
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3
                       focus:border-amber-700 focus:ring-2 focus:ring-amber-100"
            >
        </div>

        <div>
            <label for="categoria"
                   class="block text-sm font-medium text-gray-700 mb-2">
                Filtrar por categoría
            </label>

            <select
                id="categoria"
                name="categoria"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3
                       focus:border-amber-700 focus:ring-2 focus:ring-amber-100"
            >
                <option value="">Todas las categorías</option>

                @foreach($categorias as $categoria)
                    <option
                        value="{{ $categoria->_id }}"
                        @selected((string) $categoriaSeleccionada === (string) $categoria->_id)
                    >
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-3 flex flex-wrap gap-3">
            <button
                type="submit"
                class="rounded-xl bg-amber-700 px-6 py-3 font-semibold text-white
                       hover:bg-amber-800 transition"
            >
                Buscar muebles
            </button>

            <a
                href="{{ route('catalogo') }}"
                class="rounded-xl border border-gray-300 bg-white px-6 py-3
                       font-semibold text-gray-700 hover:bg-gray-50 transition"
            >
                Limpiar filtros
            </a>
        </div>

    </form>

    {{-- Resultados --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h2 class="text-xl font-semibold text-gray-900">
            Muebles disponibles
        </h2>

        <p class="text-sm text-gray-500">
            {{ $muebles->count() }}
            {{ $muebles->count() === 1 ? 'resultado' : 'resultados' }}
        </p>
    </div>

    {{-- Tarjetas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($muebles as $mueble)

            <article class="group overflow-hidden rounded-2xl bg-white
                            border border-gray-100 shadow-sm
                            hover:shadow-lg transition">

                {{-- Imagen --}}
                <div class="h-64 bg-white overflow-hidden">
                    @if($mueble->imagen)
                        <img
                            src="{{ asset('storage/' . $mueble->imagen) }}"
                            alt="{{ $mueble->nombre }}"
                            loading="lazy"
                            class="h-full w-full object-contain p-3
                                   group-hover:scale-105 transition duration-300"
                        >
                    @else
                        <div class="flex h-full items-center justify-center text-gray-400">
                            Imagen no disponible
                        </div>
                    @endif
                </div>

                {{-- Información --}}
                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $mueble->nombre }}
                    </h3>
<!-- ver -->
                    <p class="text-sm text-gray-500 mb-4">
                        <!-- {{ data_get($mueble, 'categoria.nombre', 'Mueble personalizado') }} -->
                         {{ $mueble->categoria->nombre ?? 'Mueble personalizado' }}
                    </p>

                    <p class="text-sm text-gray-600 mb-5">
                        {{ \Illuminate\Support\Str::limit($mueble->descripcion ?? '', 100) }}
                    </p>

                    <div class="flex items-center justify-between gap-3 mb-5">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Precio referencial
                            </p>

                            <p class="text-2xl font-bold text-amber-700">
                                Bs. {{ number_format((float) $mueble->precio, 2, ',', '.') }}
                            </p>
                        </div>

                        @if($mueble->estado)
                            <span class="rounded-full bg-green-50 px-3 py-1
                                         text-xs font-semibold text-green-700">
                                Disponible
                            </span>
                        @else
                            <span class="rounded-full bg-gray-100 px-3 py-1
                                         text-xs font-semibold text-gray-600">
                                No disponible
                            </span>
                        @endif
                    </div>

                    <a
                        href="{{ route('muebles.detalle', $mueble->_id) }}"
                        class="block w-full rounded-xl bg-amber-700 px-4 py-3
                               text-center font-semibold text-white
                               hover:bg-amber-800 transition"
                    >
                        Ver detalles
                    </a>

                </div>

            </article>

        @empty

            <div class="sm:col-span-2 lg:col-span-3 rounded-2xl
                        border border-dashed border-gray-300 bg-white
                        px-6 py-16 text-center">

                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    No encontramos muebles
                </h3>

                <p class="text-gray-500 mb-6">
                    Prueba con otro nombre o selecciona una categoría diferente.
                </p>

                <a
                    href="{{ route('catalogo') }}"
                    class="inline-block rounded-xl bg-amber-700 px-6 py-3
                           font-semibold text-white hover:bg-amber-800 transition"
                >
                    Ver todos los muebles
                </a>

            </div>

        @endforelse

    </div>

</section>

@endsection