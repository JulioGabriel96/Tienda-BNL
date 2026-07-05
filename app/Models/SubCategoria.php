<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;

    protected $table = 'sub_categorias';

    protected $fillable = [
        'nombre',
        'estado',
        'descripcion',
        'categoria_id',
    ];

    # defino el tipo de dato del campo estado
    protected $casts = [
        'estado' => 'boolean',
    ]; 
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
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
