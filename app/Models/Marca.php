<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function scopeBuscar($query, $filtros)
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
