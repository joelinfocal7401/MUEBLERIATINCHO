<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class MaterialController extends Controller
{
 
        /**
     * Mostrar listado de materiales
     */
    public function index()
    {
    $materiales = Material::with('proveedor')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('materiales.index', compact('materiales'));
    }

    /**
     * Mostrar formulario de registro
     */
    public function create()
    {
            $proveedores = Proveedor::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('materiales.create', compact('proveedores'));
    }

    /**
     * Guardar material
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
            'unidad' => 'required|string|max:50',
            'proveedor_id' => 'required',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'estado' => 'required|boolean',
        ]);

        Material::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'unidad' => $request->unidad,
            'stock' => $request->stock,
            'stock_minimo' => $request->stock_minimo,
            'precio_compra' => $request->precio_compra,
            'proveedor_id' => $request->proveedor_id,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('materiales.index')
            ->with('success', 'Material registrado correctamente.');
    }

    /**
     * Mostrar detalle
     */
    public function show(string $id)
    {
        $material = Material::findOrFail($id);

        $proveedor = null;

        if ($material->proveedor_id) {
            $proveedor = Proveedor::find($material->proveedor_id);
        }

        return view('materiales.show', compact(
            'material',
            'proveedor'
        ));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(string $id)
    {
            $material = Material::findOrFail($id);

            $proveedores = Proveedor::where('estado', true)
                ->orderBy('nombre')
                ->get();

            return view('materiales.edit', compact(
                'material',
                'proveedores'
            ));

    }

    /**
     * Actualizar material
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
            'unidad' => 'required|string|max:50',
            'proveedor_id' => 'required',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'estado' => 'required|boolean',
        ]);

        $material = Material::findOrFail($id);

        $material->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'unidad' => $request->unidad,
            'stock' => $request->stock,
            'stock_minimo' => $request->stock_minimo,
            'precio_compra' => $request->precio_compra,
            'proveedor_id' => $request->proveedor_id,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('materiales.index')
            ->with('success', 'Material actualizado correctamente.');
    }

    /**
     * Eliminar material
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return redirect()
            ->route('materiales.index')
            ->with('success', 'Material eliminado correctamente.');
    }
}
