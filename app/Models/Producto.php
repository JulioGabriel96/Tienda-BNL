<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'codigo_barra',
        'nombre',
        'descripcion',
        'precio_costo',
        'porcentaje_ganancia',
        'precio_venta',
        'stock_minimo',
        'stock_actual',
        'estado',
        'subcategoria_id',
        'marca_id',
    ];

    protected $casts = [
        'precio_costo' => 'decimal:2',
        'porcentaje_ganancia' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'stock_minimo' => 'integer',
        'stock_actual' => 'integer',
        'estado' => 'boolean',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class);
    }

    public function ventasDetalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }

    public function scopeBuscar($query, array $filtros)
    {
        if (! empty($filtros['buscar'])) {
            $buscar = $filtros['buscar'];

            $query->where(function ($query) use ($buscar) {
                $query->where('codigo', 'like', "%{$buscar}%")
                    ->orWhere('codigo_barra', 'like', "%{$buscar}%")
                    ->orWhere('nombre', 'like', "%{$buscar}%")
                    ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        if (! empty($filtros['marca_id'])) {
            $query->where('marca_id', $filtros['marca_id']);
        }

        if (! empty($filtros['categoria_id'])) {
            $query->whereHas('subcategoria', function ($query) use ($filtros) {
                $query->where('categoria_id', $filtros['categoria_id']);
            });
        }

        if (isset($filtros['estado']) && $filtros['estado'] !== '') {
            $query->where('estado', $filtros['estado']);
        }

        return $query;
    }
}
