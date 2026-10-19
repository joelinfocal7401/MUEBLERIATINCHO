<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Mostrar listado de proveedores
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('created_at', 'desc')->get();

        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Mostrar formulario de registro
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Guardar proveedor
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'empresa' => 'required|string|max:150',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        Proveedor::create([
            'nombre' => $request->nombre,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Mostrar detalle
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Actualizar proveedor
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'empresa' => 'required|string|max:150',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update([
            'nombre' => $request->nombre,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'estado' => (bool) $request->estado,
        ]);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Eliminar proveedor
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}
