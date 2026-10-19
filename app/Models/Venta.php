<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;
use App\Models\MuebleStock;

class Venta extends Model
{
 
    protected $connection = 'mongodb';

    protected $collection = 'ventas';


    protected $fillable = [

        // Datos generales
        'codigo',
        'cliente_id',
        'solicitud_id',
        'origen',
        'estado',

        'mueble_id',
        'cantidad',
        'precio_unitario',

        'muebles',

        'tipo_entrega',
        'direccion_entrega',
        'costo_transporte',
        'fecha_entrega',

        'total',
        'adelanto',
        'monto_a_pagar',
        'saldo_pendiente',

        // Pago
        'metodo_pago',
        'tipo_pago',
        'fecha_limite_pago',
        'fecha_pago_notificado',
        'fecha_pago_confirmado',

        // Observaciones
        // 'observaciones',
    ];

    protected $casts = [
        'cantidad' => 'integer',

        'precio_unitario' => 'float',
        'total' => 'float',
        'costo_transporte' => 'float',
        'adelanto' => 'float',
        'monto_a_pagar' => 'float',
        'saldo_pendiente' => 'float',

        'muebles' => 'array',

        'fecha_entrega' => 'datetime',
        'fecha_limite_pago' => 'datetime',
        'fecha_pago_notificado' => 'datetime',
        'fecha_pago_confirmado' => 'datetime',
    ];

   
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function mueble()
    {
        return $this->belongsTo(
            MuebleStock::class,
            'mueble_id'
        );
    }
}