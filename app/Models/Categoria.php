<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    # defino nombre de la tabla
    protected $table = 'categorias';

    # defino los campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    # defino el tipo de dato del campo estado
    protected $casts = [
        'estado' => 'boolean',
    ]; 
 
    # defino relacion uno a muchos
    public function subcategorias()
    { 
        return $this->hasMany(Subcategoria::class);
    }
    

    public function scopeBuscar($query, $filtros)
    {
        if (!empty($filtros['nombre'])) {
        $query->where('nombre', 'like', '%' . $filtros['nombre'] . '%');
        }

        if (isset($filtros['estado']) && $filtros['estado'] !== '') {
            $query->where('estado', $filtros['estado']);
        }

        return $query;
    
    }
}
 