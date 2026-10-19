<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * map de usuarios.
     */
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para registrar un usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Registrar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:admin,cliente',
            'estado' => 'required|in:activo,inactivo',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Mostrar info de un usuario.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario para editar usuario.
     */
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol' => 'required|in:admin,cliente',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'rol' => $request->rol,
            'estado' => $request->estado,
        ];

        // Cambiar contraseña solamente si se escribió una nueva.
        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);

        // Evitar que el administrador elimine su propia cuenta.
        if ((string) $usuario->id === (string) auth()->id()) {
            return redirect()
                ->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}