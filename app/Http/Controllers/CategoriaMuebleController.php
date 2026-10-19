<?php

namespace App\Http\Controllers;

use App\Models\CategoriaMueble;
use Illuminate\Http\Request;

class CategoriaMuebleController extends Controller
{
     /**
     * Mostrar listado de categorías
     */
    public function index()
    {
        $categorias = CategoriaMueble::orderBy('created_at', 'desc')->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulario de registro
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guardar nueva categoría
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        CategoriaMueble::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    /**
     * Mostrar detalle
     */
    public function show(string $id)
    {
        $categoria = CategoriaMueble::findOrFail($id);

        return view('categorias.show', compact('categoria'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(string $id)
    {
        $categoria = CategoriaMueble::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $categoria = CategoriaMueble::findOrFail($id);

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar categoría
     */
    public function destroy(string $id)
    {
        $categoria = CategoriaMueble::findOrFail($id);

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
