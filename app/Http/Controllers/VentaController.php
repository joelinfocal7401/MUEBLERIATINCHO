<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MuebleStock;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
        public function index()
        {
            $ventas = Venta::with([
                'cliente',
                'mueble'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

            return view(
                'ventas.index',
                compact('ventas')
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

            $muebles = MuebleStock::orderBy('nombre')->get();
            return view(
                'ventas.create',
                compact(
                    'clientes',
                    'muebles'
                )
            );
        }
        
        public function store(Request $request)
        {
            $request->validate([
                'cliente_id' => 'required',
                'mueble_id' => 'required',
                'cantidad' => 'required|integer|min:1',
                'metodo_pago' => 'required',
                'estado' => 'required',
            ]);

            $mueble = MuebleStock::findOrFail(
                $request->mueble_id
            );

            if ($request->cantidad > $mueble->stock) {

                return back()
                    ->withErrors([
                        'cantidad' =>
                        'La cantidad supera el stock disponible.'
                    ])
                    ->withInput();
            }

            $precioUnitario = $mueble->precio;

            $total = $precioUnitario *
                    $request->cantidad;

            Venta::create([
                'codigo' => 'VEN-' . strtoupper(substr(uniqid(), -6)),

                'cliente_id' => $request->cliente_id,

                'mueble_id' => $request->mueble_id,

                'cantidad' => $request->cantidad,

                'precio_unitario' => $precioUnitario,

                'total' => $total,

                'metodo_pago' => $request->metodo_pago,

                'estado' => $request->estado,
            ]);

            $nuevoStock = (int) $mueble->stock - (int) $request->cantidad;

            $mueble->update([
                'stock' => $nuevoStock
            ]);

            return redirect()
                ->route('ventas.index')
                ->with(
                    'success',
                    'Venta registrada correctamente.'
                );
        }


        public function show(string $id)
        {
            $venta = Venta::with([
                'cliente',
                'mueble'
            ])->findOrFail($id);

            return view(
                'ventas.show',
                compact('venta')
            );
        }

        public function edit(string $id){
            $venta = Venta::findOrFail($id);

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

            $muebles = MuebleStock::where(
                'estado',
                true
            )
            ->orderBy('nombre')
            ->get();

            return view(
                'ventas.edit',
                compact(
                    'venta',
                    'clientes',
                    'muebles'
                )
            );
        }
        

        public function update(
            Request $request,
            string $id
        )
        {
            $request->validate([
                'cliente_id' => 'required',
                'mueble_id' => 'required',
                'cantidad' => 'required|integer|min:1',
                'metodo_pago' => 'required',
                'estado' => 'required',
            ]);

            $venta = Venta::findOrFail($id);

            // Mueble original de la venta
            $muebleAnterior = MuebleStock::findOrFail(
                $venta->mueble_id
            );

            // Devolver al stock la cantidad anterior
            $muebleAnterior->update([
                'stock' => (int)$muebleAnterior->stock + (int)$venta->cantidad
            ]);

            // Mueble seleccionado actualmente
            $muebleNuevo = MuebleStock::findOrFail(
                $request->mueble_id
            );

            // Verificar stock
            if ((int)$request->cantidad > (int)$muebleNuevo->stock) {

                return back()
                    ->withErrors([
                        'cantidad' => 'La cantidad supera el stock disponible.'
                    ])
                    ->withInput();
            }

            // Descontar nueva cantidad
            $muebleNuevo->update([
                'stock' => (int)$muebleNuevo->stock - (int)$request->cantidad
            ]);

            $precioUnitario = $muebleNuevo->precio;

            $total = $precioUnitario * $request->cantidad;

            $venta->update([
                'cliente_id' => $request->cliente_id,
                'mueble_id' => $request->mueble_id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $precioUnitario,
                'total' => $total,
                'metodo_pago' => $request->metodo_pago,
                'estado' => $request->estado,
            ]);

            return redirect()
                ->route('ventas.index')
                ->with(
                    'success',
                    'Venta actualizada correctamente.'
                );
        }
                public function destroy(string $id)
                {
                $venta = Venta::findOrFail($id);

                $venta->delete();

                return redirect()
                    ->route('ventas.index')
                    ->with(
                        'success',
                        'Venta eliminada correctamente.'
                    );
                }


                public function solicitudesWeb()
                {
                    $solicitudes = DB::connection('mongodb')
                        ->table('solicitudes_web')
                        ->orderBy('created_at', 'desc')
                        ->get();

                    foreach ($solicitudes as $solicitud) {
                        // Normalizar el identificador de MongoDB.
                        $solicitud->solicitud_id = (string) (
                            $solicitud->_id
                            ?? $solicitud->id
                            ?? ''
                        );

                        $solicitud->cliente = User::find(
                            $solicitud->cliente_id
                        );
                    }

                    return view(
                        'ventas.solicitudes-web',
                        compact('solicitudes')
                    );
                }

           
public function formularioCotizacion(string $id)
{
    $solicitud = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->first();

    if (!$solicitud) {
        abort(404, 'La solicitud web no existe.');
    }

    $cliente = User::find($solicitud->cliente_id);

    return view(
        'ventas.cotizar-web',
        compact('solicitud', 'cliente')
    );
}


public function guardarCotizacion(Request $request, string $id)
{
    $datos = $request->validate([
        'costo_transporte' => 'required|numeric|min:0',
        'fecha_entrega' => 'required|date|after_or_equal:today',
        'observaciones' => 'nullable|string|max:1000',
    ]);

    $solicitud = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->first();

    if (!$solicitud) {
        abort(404, 'La solicitud web no existe.');
    }

    if ($solicitud->estado !== 'pendiente_cotizacion') {
        return redirect()
            ->route('solicitudes-web.index')
            ->with('error', 'Esta solicitud ya fue cotizada o no está pendiente.');
    }

 

    $subtotal = (float) ($solicitud->subtotal ?? 0);
    $transporte = ($solicitud->tipo_entrega ?? '') === 'transporte'
        ? (float) $datos['costo_transporte']
        : 0.00;

    $total = round($subtotal + $transporte, 2);
    $adelanto = round($total * 0.50, 2);
    $saldo = round($total - $adelanto, 2);


    DB::connection('mongodb')
        ->table('solicitudes_web')
            ->where('_id', $id)
        ->update([
            'costo_transporte' => $transporte,
            'total' => $total,
            'adelanto' => $adelanto,
            'monto_a_pagar' => $adelanto,
            'fecha_entrega' => $datos['fecha_entrega'],
            'observaciones' => $datos['observaciones'] ?? null,
            'estado' => 'cotizado',
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('solicitudes-web.index')
        ->with('success', 'La cotización se guardó correctamente.');
}

          
public function pagosNotificados()
{
    $solicitudes = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('estado', 'pago_notificado')
        ->orderBy('created_at', 'desc')
        ->get();

    foreach ($solicitudes as $solicitud) {
        $solicitud->solicitud_id = (string) (
            $solicitud->_id
            ?? $solicitud->id
            ?? ''
        );

        $solicitud->cliente = User::find(
            $solicitud->cliente_id
        );
    }

    return view(
        'ventas.pagos-notificados',
        compact('solicitudes')
    );
}

// ver

public function confirmarPagoWeb(string $id)
{
    $conexion = DB::connection('mongodb');

    // Buscar la solicitud web.
    $solicitud = $conexion
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->first();

    if (!$solicitud) {
        abort(404, 'La solicitud web no existe.');
    }

    // Solo se confirma un pago notificado.
    if ($solicitud->estado !== 'pago_notificado') {
        return redirect()
            ->route('solicitudes-web.pagos-notificados')
            ->with('error', 'La solicitud no tiene un pago pendiente de verificación.');
    }

    // Evitar registrar dos veces la misma compra.
    $ventaExistente = Venta::where('solicitud_id', $id)->first();

    if ($ventaExistente) {
        $conexion->table('solicitudes_web')
            ->where('_id', $id)
            ->update([
                'estado' => 'pago_confirmado',
                'fecha_pago_confirmado' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('solicitudes-web.pagos-notificados')
            ->with('success', 'Esta compra ya estaba registrada.');
    }

    $muebles = $solicitud->muebles ?? [];

    if (is_object($muebles)) {
        $muebles = (array) $muebles;
    }

    if (!is_array($muebles) || count($muebles) === 0) {
        return back()->with(
            'error',
            'La solicitud no contiene muebles válidos.'
        );
    }

    // Validar todos los muebles antes de descontar stock.
    $mueblesVenta = [];

    foreach ($muebles as $item) {
        $item = (array) $item;

        $muebleId = $item['mueble_id'] ?? null;
        $cantidad = (int) ($item['cantidad'] ?? 0);

        if (!$muebleId || $cantidad < 1) {
            return back()->with(
                'error',
                'Hay un mueble o una cantidad inválida en la solicitud.'
            );
        }

        $mueble = MuebleStock::find($muebleId);

        if (!$mueble) {
            return back()->with(
                'error',
                'Uno de los muebles solicitados ya no existe.'
            );
        }

        if ((int) $mueble->stock < $cantidad) {
            return back()->with(
                'error',
                'Stock insuficiente para: ' . $mueble->nombre
                . '. No se registró la venta.'
            );
        }

        $precio = (float) ($item['precio_unitario'] ?? $mueble->precio);

        $mueblesVenta[] = [
            'mueble_id' => (string) $muebleId,
            'nombre' => $item['nombre'] ?? $mueble->nombre,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio,
            'subtotal' => round($precio * $cantidad, 2),
        ];
    }

    // Preparar los importes de la compra.
    $total = (float) ($solicitud->total ?? 0);
    $adelantoCotizado = (float) ($solicitud->adelanto ?? 0);
    $montoPagado = (float) ($solicitud->monto_a_pagar ?? 0);

    if ($montoPagado <= 0 || $montoPagado > $total) {
        return back()->with(
            'error',
            'Los importes de la solicitud no son válidos.'
        );
    }

    $saldoPendiente = round($total - $montoPagado, 2);

    // Registrar la venta web.
    $venta = Venta::create([
        'codigo' => 'WEB-' . strtoupper(substr(uniqid(), -6)),
        'cliente_id' => (string) $solicitud->cliente_id,
        'solicitud_id' => $id,
        'origen' => 'web',
        'estado' => 'confirmada',

        'muebles' => $mueblesVenta,

        'tipo_entrega' => $solicitud->tipo_entrega ?? 'recoger',
        'direccion_entrega' => $solicitud->direccion_entrega ?? null,
        'costo_transporte' => (float) ($solicitud->costo_transporte ?? 0),
        'fecha_entrega' => $solicitud->fecha_entrega ?? null,

        'total' => $total,
        'adelanto' => $adelantoCotizado,
        'monto_a_pagar' => $montoPagado,
        'saldo_pendiente' => $saldoPendiente,

        'metodo_pago' => $solicitud->metodo_pago ?? 'QR',
        'tipo_pago' => $solicitud->tipo_pago ?? null,

        'fecha_pago_notificado' =>
            $solicitud->pago_notificado_at ?? now(),
        'fecha_pago_confirmado' => now(),

        'observaciones' => $solicitud->observaciones ?? null,
    ]);

    // Descontar el stock de cada mueble.
    foreach ($mueblesVenta as $item) {
        $mueble = MuebleStock::findOrFail($item['mueble_id']);

        $mueble->update([
            'stock' => (int) $mueble->stock - $item['cantidad'],
        ]);
    }

    // Marcar la solicitud como pagada y procesada.
    $conexion->table('solicitudes_web')
        ->where('_id', $id)
        ->update([
            'estado' => 'pago_confirmado',
            'fecha_pago_confirmado' => now(),
            'venta_id' => (string) $venta->getKey(),
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('solicitudes-web.pagos-notificados')
        ->with('success', 'Pago confirmado y venta web registrada correctamente.');
}

}
