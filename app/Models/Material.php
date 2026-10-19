<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Material extends Model
{
     protected $connection = 'mongodb';

    protected $collection = 'materiales';

    protected $fillable = [
        'nombre',
        'tipo',
        'unidad',
        'stock',
        'stock_minimo',
        'precio_compra',
        'proveedor_id',
        'estado',
    ];

    protected $casts = [
        'stock' => 'integer',
        'stock_minimo' => 'integer',
        'precio_compra' => 'float',
        'estado' => 'boolean',
    ];
    public function proveedor()
{
    return $this->belongsTo(
        Proveedor::class,
        'proveedor_id'
    );
}
}
