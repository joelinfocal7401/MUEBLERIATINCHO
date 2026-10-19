<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;
use App\Models\CategoriaMueble;

class Pedido extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'pedidos';

    protected $fillable = [

        'codigo',

        'cliente_id',

        'categoria_id',

        'cantidad',

        'ancho',
        'alto',
        'profundidad',

        'color',

        'imagen_referencia',

        'observaciones',

        'tipo_entrega',

        'direccion_entrega',

        'costo_transporte',

        'precio_total',

        'adelanto',

        'fecha_entrega',

        'fecha_confirmacion',

        'fecha_pago_confirmado',

        'estado',

        'bloqueado_hasta',

        'motivo_cancelacion',

        'comprobante_pago',
    ];

    protected $casts = [

        'cantidad' => 'integer',

        'ancho' => 'float',
        'alto' => 'float',
        'profundidad' => 'float',

        'costo_transporte' => 'float',

        'precio_total' => 'float',

        'adelanto' => 'float',

        'fecha_entrega' => 'datetime',

        'fecha_confirmacion' => 'datetime',

        'fecha_pago_confirmado' => 'datetime',

        'bloqueado_hasta' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(
            User::class,
            'cliente_id'
        );
    }

    public function categoria()
    {
        return $this->belongsTo(
            CategoriaMueble::class,
            'categoria_id'
        );
    }
}