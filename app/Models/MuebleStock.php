<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class MuebleStock extends Model
{
     protected $connection = 'mongodb';

    protected $collection = 'muebles_stock';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'estado',
    ];

    protected $casts = [
        'precio' => 'float',
        'stock' => 'integer',
        'estado' => 'boolean',
    ];
  //ver
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(
            CategoriaMueble::class,
            'categoria_id',
            '_id'
        );
    }
    
}


//ver limit cant