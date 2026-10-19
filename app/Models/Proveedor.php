<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Proveedor extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'proveedores';

    protected $fillable = [
        'nombre',
        'empresa',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
