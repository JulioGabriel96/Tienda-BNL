<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $table = 'tipo_clientes';

    protected $fillable = [
        'nombre',
        'estado',
        'descuento',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'descuento' => 'integer',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function scopeBuscar($query, array $filtros)
    {
        if (! empty($filtros['nombre'])) {
            $query->where('nombre', 'like', '%'.$filtros['nombre'].'%');
        }

        if (isset($filtros['estado']) && $filtros['estado'] !== '') {
            $query->where('estado', $filtros['estado']);
        }

        return $query;
    }
}
