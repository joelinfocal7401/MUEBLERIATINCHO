<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MuebleStock;

class DashboardController extends Controller
{
     public function index(){
        $user = auth()->user();

        if ($user->rol === 'admin') {
            return view('dashboard.admin');
        }

        return view('dashboard.cliente');
        }
   
// public function misPedidos()
// {
//     $solicitudes = DB::connection('mongodb')
//         ->table('solicitudes_web')
//         ->where('cliente_id', (string) auth()->id())
//         ->orderBy('created_at', 'desc')
//         ->get();

//     foreach ($solicitudes as $solicitud) {
//         $solicitud->solicitud_id = (string) (
//             $solicitud->_id
//             ?? $solicitud->id
//             ?? ''
//         );
//     }

    // ver si ta bien 

public function misPedidos()
{
    $solicitudes = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('cliente_id', (string) auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    foreach ($solicitudes as $solicitud) {
        $solicitud->solicitud_id = (string) (
            $solicitud->_id ?? $solicitud->id ?? ''
        );
        $muebles = $solicitud->muebles ?? [];

        foreach ($muebles as $indice => $mueble) {
            $muebleId = $mueble['mueble_id'] ?? null;

            $producto = $muebleId
                ? MuebleStock::find($muebleId)
                : null;

            $mueble['imagen_url'] = (
                $producto && $producto->imagen
            )
                ? asset('storage/' . $producto->imagen)
                : null;

            $muebles[$indice] = $mueble;
        }

        $solicitud->muebles = $muebles;
    }

    return view('cliente.mis-pedidos', compact('solicitudes'));
}



// public function aceptarCotizacion(Request $request, string $id)
// {
//     $datos = $request->validate([
//         'tipo_pago' => 'required|in:adelanto,total',
//     ]);

//     $solicitud = DB::connection('mongodb')
//         ->table('solicitudes_web')
//         ->where('_id', $id)
//         ->where('cliente_id', (string) auth()->id())
//         ->first();

//     if (!$solicitud) {
//         abort(404, 'No se encontró tu solicitud.');
//     }

//     if (($solicitud->estado ?? '') !== 'cotizado') {
//         return redirect()
//             ->route('cliente.mis-pedidos')
//             ->with('error', 'Esta cotización ya no está disponible para aceptar.');
//     }

//     $total = (float) ($solicitud->total ?? 0);
//     $adelanto = round($total * 0.50, 2);

//     $montoAPagar = $datos['tipo_pago'] === 'total'
//         ? $total
//         : $adelanto;

//     DB::connection('mongodb')
//         ->table('solicitudes_web')
//         ->where('_id', $id)
//         ->where('cliente_id', (string) auth()->id())
//         ->update([
//             'tipo_pago' => $datos['tipo_pago'],
//             'monto_a_pagar' => $montoAPagar,
//             'estado' => 'pendiente_pago',
//             'updated_at' => now(),
//         ]);

//     return redirect()
//         ->route('cliente.mis-pedidos')
//         ->with('success', 'Cotización aceptada. Ahora puedes continuar con el pago.');
// }


public function aceptarCotizacion(Request $request, string $id)
{
    $datos = $request->validate([
        'tipo_pago' => 'required|in:adelanto,total',
    ]);

    $solicitud = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->first();

    if (!$solicitud) {
        abort(404, 'No se encontró tu solicitud.');
    }

    if (($solicitud->estado ?? '') !== 'cotizado') {
        return redirect()
            ->route('cliente.mis-pedidos')
            ->with('error', 'Esta cotización ya no está disponible.');
    }

    $total = (float) ($solicitud->total ?? 0);
    $monto = $datos['tipo_pago'] === 'total'
        ? $total
        : round($total * 0.50, 2);

    DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->where('estado', 'cotizado')
        ->update([
            'tipo_pago' => $datos['tipo_pago'],
            'monto_a_pagar' => $monto,
            'estado' => 'pendiente_pago',
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('cliente.mis-pedidos')
        ->with('abrir_pago', $id)
        ->with('success', 'Cotización aceptada. Revisa los datos antes de pagar.');
}

public function notificarPago(string $id)
{
    $solicitud = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->first();

    if (!$solicitud) {
        abort(404, 'No se encontró tu solicitud.');
    }

    if (($solicitud->estado ?? '') !== 'pendiente_pago') {
        return redirect()
            ->route('cliente.mis-pedidos')
            ->with('error', 'La solicitud ya no está pendiente de pago.');
    }

    DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->where('estado', 'pendiente_pago')
        ->update([
            'estado' => 'pago_notificado',
            'pago_notificado_at' => now(),
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('cliente.mis-pedidos')
        ->with('pago_notificado', true)
        ->with('success', 'Tu pago fue notificado. Espera la validación del administrador.');
}

public function cancelarPago(string $id)
{
    $solicitud = DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->first();

    if (!$solicitud) {
        abort(404, 'No se encontró tu solicitud.');
    }

    if (($solicitud->estado ?? '') !== 'pendiente_pago') {
        return redirect()
            ->route('cliente.mis-pedidos')
            ->with('error', 'Esta solicitud ya no se puede cancelar desde el pago.');
    }

    DB::connection('mongodb')
        ->table('solicitudes_web')
        ->where('_id', $id)
        ->where('cliente_id', (string) auth()->id())
        ->where('estado', 'pendiente_pago')
        ->update([
            'estado' => 'cancelado',
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('cliente.mis-pedidos')
        ->with('success', 'La solicitud fue cancelada. No se descontó stock.');
}

}


