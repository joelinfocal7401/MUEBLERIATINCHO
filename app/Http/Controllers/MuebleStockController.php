<?php

namespace App\Http\Controllers;

use App\Models\MuebleStock;
use App\Models\CategoriaMueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MuebleStockController extends Controller
{
    /**
     * Mostrar todos los muebles.
     */
    public function index()
    {
        $muebles = MuebleStock::orderBy('created_at', 'desc')->get();

        return view('muebles-stock.index', compact('muebles'));
    }

    /**
     * Mostrar formulario para registrar un mueble.
     */
    public function create()
    {
        $categorias = CategoriaMueble::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('muebles-stock.create', compact('categorias'));
    }

    /**
     * Registrar un nuevo mueble.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'categoria_id' => 'required|string',
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $imagen = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('muebles', 'public');
        }

        MuebleStock::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            // 'stock' => $request->stock,
            'stock' => (int) $request->stock,
            'imagen' => $imagen,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('muebles-stock.index')
            ->with('success', 'Mueble registrado correctamente.');
    }

    /**
     * Mostrar detalle de un mueble.
     */
    public function show(MuebleStock $muebleStock)
    {
        $categoria = CategoriaMueble::find($muebleStock->categoria_id);

        return view('muebles-stock.show', compact(
            'muebleStock',
            'categoria'
        ));
    }

    /**
     * Mostrar formulario para editar un mueble.
     */
    public function edit(MuebleStock $muebleStock)
    {
        $categorias = CategoriaMueble::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('muebles-stock.edit', compact(
            'muebleStock',
            'categorias'
        ));
    }

    /**
     * Actualizar un mueble.
     */
    public function update(Request $request, MuebleStock $muebleStock)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'categoria_id' => 'required|string',
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $imagen = $muebleStock->imagen;

        if ($request->hasFile('imagen')) {

            if ($muebleStock->imagen) {
                Storage::disk('public')->delete($muebleStock->imagen);
            }

            $imagen = $request->file('imagen')->store('muebles', 'public');
        }

        $muebleStock->update([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            // 'stock' => $request->stock,
            'stock' => (int) $request->stock,
            'imagen' => $imagen,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('muebles-stock.index')
            ->with('success', 'Mueble actualizado correctamente.');
    }

    /**
     * Eliminar un mueble.
     */
    public function destroy(MuebleStock $muebleStock)
    {
        if ($muebleStock->imagen) {
            Storage::disk('public')->delete($muebleStock->imagen);
        }

        $muebleStock->delete();

        return redirect()
            ->route('muebles-stock.index')
            ->with('success', 'Mueble eliminado correctamente.');
    }
}