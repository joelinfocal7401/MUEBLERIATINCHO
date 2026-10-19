<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MovimientoStock extends Model
{
      protected $connection = 'mongodb';

    protected $collection = 'movimientos_stock';

    protected $fillable = [
        'material_id',

        'tipo',

        'cantidad',

        'motivo',

        'usuario_id',
    ];

    protected $casts = [
        'cantidad' => 'integer',
    ];
}
