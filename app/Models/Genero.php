<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'generos';

    protected $fillable = [
        'nombre',
    ];

    // 1 genero puede tener muchos clientes
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

     public function scopeBuscar($query, array $filtros)
    {
        if (! empty($filtros['nombre'])) {
            $query->where('nombre', 'like', '%'.$filtros['nombre'].'%');
        }
        
        return $query;
    }
    
}
