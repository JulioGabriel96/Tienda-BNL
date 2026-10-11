<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaModelo extends Model
{
    use HasFactory;

    protected $table = 'marcas_modelos';

    protected $fillable = [
        'marca_id',
        'modelo_id',
        'estado'
    ];  

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function scopeBuscar($query, $filtros)
    {
        if (isset($filtros['modelo_id']) && $filtros['modelo_id'] != '') {
            $query->where('modelo_id', $filtros['modelo_id']);
        }

        if (isset($filtros['estado']) && $filtros['estado'] != '') {
            $query->where('estado', $filtros['estado']);
        }
        return $query;
    }

    
    public function marca_vehiculo()
    {
        return $this->belongsTo(MarcaVehiculo::class, 'marca_id');
    }

    public function modelo_vehiculo()
    {
        return $this->belongsTo(ModeloVehiculo::class, 'modelo_id');
    }

    public function mostrarTipoBotones(): string
    {
        $estado = $this->estado ? 'fas fa-ban' : 'fas fa-check';
        return $estado; 
    }

    public function mostrarMensajeConfirmacion(): string
    {
        $mensaje = $this->estado ? '¿Está seguro que quiere desactivar el modelo asociado?.' : '¿Está seguro que quiere activar el modelo asociado?.';
        return $mensaje;
    }

    public function mostrarTipoColores(): string
    {
        $color = $this->estado ? 'btn btn-outline-danger btn-sm' : 'btn btn-outline-success btn-sm';
        return $color;
    }
}
