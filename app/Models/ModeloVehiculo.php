<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ModeloVehiculo extends Model
{
    use HasFactory;
    protected $table = 'modelos_vehiculos';

    protected $fillable = [
        'nombre',
    ];

     public function scopeBuscar($query, $filtros)
    {
        if (! empty($filtros['nombre'])) {
            $query->where('nombre', 'like', '%'.$filtros['nombre'].'%');
        }

        return $query;
    }

}
