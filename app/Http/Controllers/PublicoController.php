<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MuebleStock;
use App\Models\CategoriaMueble;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;

class PublicoController extends Controller
{
    public function home()
    {
        $muebles = MuebleStock::where('estado', true)
            ->take(6)
            ->get();

        return view('publico.home', compact('muebles'));
    }

    // Catálogo  búsqueda y filtro x categoría.
    public function catalogo(Request $request)
    {
        $buscar = trim($request->input('buscar', ''));
        $categoriaSeleccionada = $request->input('categoria', '');

        $consulta = MuebleStock::where('estado', true);

        // Buscar x nombre o desc.
        if ($buscar !== '') {
            $consulta->where(function ($query) use ($buscar) {
                $query->where('nombre', 'like', '%' . $buscar . '%')
                      ->orWhere('descripcion', 'like', '%' . $buscar . '%');
            });
        }

        if ($categoriaSeleccionada !== '') {
            $consulta->where('categoria_id', $categoriaSeleccionada);
        }

    $muebles = $consulta
        ->with('categoria')
        ->orderBy('nombre')
        ->get();
        
        $categorias = CategoriaMueble::all();

        return view('publico.catalogo', compact(
            'muebles',
            'categorias',
            'buscar',
            'categoriaSeleccionada'
        ));
    }

    // Detalle mueble.
    public function detalle($id)
    {
        $mueble = MuebleStock::where('_id', $id)
            ->where('estado', true)
            ->firstOrFail();

        return view('publico.detalle', compact('mueble'));
    }

    public function nosotros()
    {
        return view('publico.nosotros');
    }

    public function contacto()
    {
        return view('publico.contacto');
    }

    
public function agregarCarrito(Request $request, string $id)
{
    $request->validate([
        'cantidad' => 'required|integer|min:1|max:4',
    ]);

    $mueble = MuebleStock::where('_id', $id)
        ->where('estado', true)
        ->firstOrFail();

    $cantidad = (int) $request->cantidad;

    if ((int) $mueble->stock < 1) {
        return back()->withErrors([
            'carrito' => 'Este mueble está agotado.',
        ]);
    }

    $carrito = session()->get('carrito_web', []);
    $idMueble = (string) $mueble->id;

    $cantidadActual = isset($carrito[$idMueble])
        ? (int) $carrito[$idMueble]['cantidad']
        : 0;

    $nuevaCantidad = $cantidadActual + $cantidad;

    if ($nuevaCantidad > 4) {
        return back()->withErrors([
            'carrito' => 'Puedes solicitar como máximo 4 unidades de cada mueble.',
        ]);
    }

    if ($nuevaCantidad > (int) $mueble->stock) {
        return back()->withErrors([
            'carrito' => 'La cantidad supera el stock disponible.',
        ]);
    }

    $carrito[$idMueble] = [
        'mueble_id' => $idMueble,
        'nombre' => $mueble->nombre,
        'precio' => (float) $mueble->precio,
        'cantidad' => $nuevaCantidad,
        'imagen' => $mueble->imagen,
    ];

    session()->put('carrito_web', $carrito);

    return redirect()
        ->route('compra.carrito')
        ->with('success', 'Mueble agregado a tu solicitud.');
}

public function carrito()
{
    $carrito = session()->get('carrito_web', []);

    return view('publico.carrito', compact('carrito'));
}

public function actualizarCarrito(Request $request, string $id)
{
    $request->validate([
        'cantidad' => 'required|integer|min:1|max:4',
    ]);

    $carrito = session()->get('carrito_web', []);

    if (!isset($carrito[$id])) {
        return redirect()->route('compra.carrito');
    }

    $mueble = MuebleStock::where('_id', $id)
        ->where('estado', true)
        ->first();

    if (!$mueble) {
        unset($carrito[$id]);
        session()->put('carrito_web', $carrito);

        return back()->withErrors([
            'carrito' => 'El mueble ya no está disponible y fue retirado de la solicitud.',
        ]);
    }

    $cantidad = (int) $request->cantidad;

    if ($cantidad > (int) $mueble->stock) {
        return back()->withErrors([
            'carrito' => 'La cantidad supera el stock disponible.',
        ]);
    }

    $carrito[$id]['cantidad'] = $cantidad;

    session()->put('carrito_web', $carrito);

    return back()->with('success', 'Cantidad actualizada.');
}

public function eliminarDelCarrito(string $id)
{
    $carrito = session()->get('carrito_web', []);

    unset($carrito[$id]);

    session()->put('carrito_web', $carrito);

    return redirect()
        ->route('compra.carrito')
        ->with('success', 'Mueble retirado de la solicitud.');
}

//ver
    
public function solicitarCotizacion(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $carrito = session()->get('carrito_web', []);

    if (empty($carrito)) {
        return redirect()
            ->route('compra.carrito')
            ->withErrors([
                'carrito' => 'Agrega al menos un mueble antes de continuar.',
            ]);
    }

    $datos = $request->validate([
        'tipo_entrega' => 'required|in:tienda,transporte',
        'direccion_entrega' => 'nullable|required_if:tipo_entrega,transporte|string|max:500',
    ]);

    $detalles = [];
    $subtotal = 0;

    foreach ($carrito as $item) {
        $mueble = MuebleStock::where('_id', $item['mueble_id'])
            ->where('estado', true)
            ->first();

        if (!$mueble) {
            return redirect()
                ->route('compra.carrito')
                ->withErrors([
                    'carrito' => 'Uno de los muebles ya no está disponible. Revisa tu solicitud.',
                ]);
        }

        $cantidad = (int) $item['cantidad'];

        if (
            $cantidad < 1 ||
            $cantidad > 4 ||
            $cantidad > (int) $mueble->stock
        ) {
            return redirect()
                ->route('compra.carrito')
                ->withErrors([
                    'carrito' => 'El stock de ' . $mueble->nombre .
                        ' cambió. Ajusta la cantidad antes de continuar.',
                ]);
        }

        $precio = (float) $mueble->precio;
        $importe = $precio * $cantidad;
        $subtotal += $importe;

        $detalles[] = [
            'mueble_id' => (string) $mueble->id,
            'nombre' => $mueble->nombre,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio,
            'subtotal' => $importe,
        ];
    }

    $codigo = 'WEB-' . strtoupper(substr(uniqid(), -6));

    // save colect
    DB::connection('mongodb')
        ->table('solicitudes_web')
        ->insert([
            'codigo' => $codigo,
            'cliente_id' => (string) Auth::id(),
            'origen' => 'web',
            'muebles' => $detalles,
            'tipo_entrega' => $datos['tipo_entrega'],
            'direccion_entrega' => $datos['tipo_entrega'] === 'transporte'
                ? $datos['direccion_entrega']
                : null,
            'subtotal' => $subtotal,
            'costo_transporte' => 0,
            'total' => $subtotal,
            'adelanto' => 0,
            'monto_a_pagar' => 0,
            'metodo_pago' => 'QR',
            'estado' => 'pendiente_cotizacion',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    // No se descuenta stock en esta etapa.
    session()->forget('carrito_web');

    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Tu solicitud ' . $codigo .
            ' fue enviada. El administrador preparará tu cotización.'
        );
}


}