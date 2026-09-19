<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    //protected $guarded = [];

    protected $casts = [
        'estado' => 'boolean',
        'fecha_nacimiento' => 'date',
    ];

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'estado',
        'fecha_nacimiento',
        'tipo_cliente_id',
        'genero_id',
    ];
 
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class);
    }

    // 1 cliente pertenece a 1 género
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    // 1 cliente puede tener muchas ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    } 

    public function scopeBuscar($query, array $filtros)
    {
        if (!empty($filtros['nombre'])) {
            $query->where('nombre', 'like', '%'.$filtros['nombre'].'%');
        }

        if (!empty($filtros['apellido'])) {
            $query->where('apellido', 'like', '%'.$filtros['apellido'].'%');
        }

        if (isset($filtros['estado']) && $filtros['estado'] !== '') {
            $query->where('estado', $filtros['estado']);
        }

        if (!empty($filtros['genero_id'])) {
            $query->where('genero_id', $filtros['genero_id']);
        }

        if (!empty($filtros['tipo_cliente_id'])) {
            $query->where('tipo_cliente_id', $filtros['tipo_cliente_id']);
        }

        return $query;
    }

}
