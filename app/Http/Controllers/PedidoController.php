<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\CategoriaMueble;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

public function index()
{
    $pedidos = Pedido::with([
        'cliente',
        'categoria'
    ])
    ->orderBy(
        'created_at',
        'desc'
    )
    ->get();

    return view(
        'pedidos.index',
        compact('pedidos')
    );
}

          public function create()
{
    $clientes = User::where(
        'rol',
        'cliente'
    )
    ->where(
        'estado',
        true
    )
    ->orderBy('nombre')
    ->get();

    $categorias = CategoriaMueble::where(
        'estado',
        true
    )
    ->orderBy('nombre')
    ->get();

    return view(
        'pedidos.create',
        compact(
            'clientes',
            'categorias'
        )
    );
}

    /** save*/
    public function store(Request $request)
{
    $request->validate([

        'cliente_id' => 'required',

        'categoria_id' => 'required',

        'cantidad' => 'required|integer|min:1|max:4',

        'ancho' => 'required|numeric|min:0|max:2.20',

        'alto' => 'required|numeric|min:0|max:2.40',

        'profundidad' => 'required|numeric|min:0|max:0.60',

        'color' => 'required',

        'tipo_entrega' => 'required',

        'fecha_entrega' => 'required',

        'estado' => 'required',
    ]);

    if ($request->tipo_entrega == 'transporte') {

        $request->validate([
            'direccion_entrega' => 'required'
        ]);
    }

    $imagen = null;

    if ($request->hasFile('imagen_referencia')) {

        $imagen = $request
            ->file('imagen_referencia')
            ->store(
                'referencias',
                'public'
            );
    }

    Pedido::create([

        'codigo' =>
        'PED-' . strtoupper(substr(uniqid(), -6)),

        'cliente_id' =>
        $request->cliente_id,

        'categoria_id' =>
        $request->categoria_id,

        'cantidad' =>
        $request->cantidad,

        'ancho' =>
        $request->ancho,

        'alto' =>
        $request->alto,

        'profundidad' =>
        $request->profundidad,

        'color' =>
        $request->color,

        'imagen_referencia' =>
        $imagen,

        'observaciones' =>
        $request->observaciones,

        'tipo_entrega' =>
        $request->tipo_entrega,

        'direccion_entrega' =>
        $request->direccion_entrega,

        'costo_transporte' =>
        $request->costo_transporte ?? 0,

        'precio_total' =>
        $request->precio_total,

        'adelanto' =>
        $request->adelanto,

        'fecha_entrega' =>
        $request->fecha_entrega,

        'estado' =>
        $request->estado,
    ]);

    return redirect()
        ->route('pedidos.index')
        ->with(
            'success',
            'Pedido registrado correctamente.'
        );
}
    
public function show(string $id)
{
    $pedido = Pedido::with([
        'cliente',
        'categoria'
    ])
    ->findOrFail($id);

    return view(
        'pedidos.show',
        compact('pedido')
    );
}


       public function edit(string $id)
{
    $pedido = Pedido::findOrFail($id);

    $clientes = User::where(
        'rol',
        'cliente'
    )
    ->where(
        'estado',
        true
    )
    ->orderBy('nombre')
    ->get();

    $categorias = CategoriaMueble::where(
        'estado',
        true
    )
    ->orderBy('nombre')
    ->get();

    return view(
        'pedidos.edit',
        compact(
            'pedido',
            'clientes',
            'categorias'
        )
    );
}
    /** Actualizar */
          public function update(
    Request $request,
    string $id){
    $request->validate([

        'cliente_id' => 'required',

        'categoria_id' => 'required',

        'cantidad' => 'required|integer|min:1|max:4',

        'ancho' => 'required',

        'alto' => 'required',

        'profundidad' => 'required',

        'color' => 'required',

        'tipo_entrega' => 'required',

        'estado' => 'required',
    ]);

    $pedido = Pedido::findOrFail($id);

    $imagen = $pedido->imagen_referencia;

    if ($request->hasFile('imagen_referencia')) {

        $imagen = $request
            ->file('imagen_referencia')
            ->store(
                'referencias',
                'public'
            );
    }

    $pedido->update([

        'cliente_id' =>
        $request->cliente_id,

        'categoria_id' =>
        $request->categoria_id,

        'cantidad' =>
        $request->cantidad,

        'ancho' =>
        $request->ancho,

        'alto' =>
        $request->alto,

        'profundidad' =>
        $request->profundidad,

        'color' =>
        $request->color,

        'imagen_referencia' =>
        $imagen,

        'observaciones' =>
        $request->observaciones,

        'tipo_entrega' =>
        $request->tipo_entrega,

        'direccion_entrega' =>
        $request->direccion_entrega,

        'costo_transporte' =>
        $request->costo_transporte,

        'precio_total' =>
        $request->precio_total,

        'adelanto' =>
        $request->adelanto,

        'fecha_entrega' =>
        $request->fecha_entrega,

        'estado' =>
        $request->estado,
    ]);

    return redirect()
        ->route('pedidos.index')
        ->with(
            'success',
            'Pedido actualizado correctamente.'
        );
}
  
   public function destroy(string $id)
{
    $pedido = Pedido::findOrFail($id);

    $pedido->delete();

    return redirect()
        ->route('pedidos.index')
        ->with(
            'success',
            'Pedido eliminado correctamente.'
        );
}
}