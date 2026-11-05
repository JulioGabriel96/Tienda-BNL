<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = "modulos";

    protected $fillable = [
        'nombre',
        'slug',
        'icono',
        'ruta',
        'estado',
        'es_visible',
        'tipo_modulo',
        'orden',
        'rela_padre',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'tipo_modulo' => 'integer',
        'es_visible' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Modulo::class, 'rela_padre');
    }

    public function modulosHijos()
    {
        return $this->hasMany(Modulo::class, 'rela_padre');
    }

    public function scopeBuscar($query, array $filtros)
    {
        if(isset($filtros['nombre']) && $filtros['nombre'] !== null) {
            $query->where('nombre', 'like', '%' . $filtros['nombre'] . '%');
        }

        if(isset($filtros['tipo_modulo']) && $filtros['tipo_modulo'] !== null) {
            $query->where('tipo_modulo', $filtros['tipo_modulo']);
        }

        if(isset($filtros['estado']) && $filtros['estado'] !== null) {
            $query->where('estado', $filtros['estado']);
        }

        if(isset($filtros['es_visible']) && $filtros['es_visible'] !== null) {
            $query->where('es_visible', $filtros['es_visible']);
        }

        return $query;
    } 

    public static function tiposModulo()
    {
        $tiposModulo =[
            1 => 'Contenedor',
            2 => 'Modulo'
        ];

        return $tiposModulo;
    }

    public static function getIconos()
    {
        $iconos = [
            'fas fa-folder',
            'fas fa-user',
            'fas fa-users',
            'fas fa-cog',
            'fas fa-people-group',
            'fas fa-shopping-cart',
            'fas fa-cash-register',
            'fas fa-credit-card',
            'fas fa-money-bill',
            'fas fa-box',
            'fas fa-file',
            'fas fa-chart-line',
            'fas fa-chart-pie',
            'fas fa-chart-bar',
            'fas fa-chart-area',
            'fas fa-list',
            'fas fa-tools',
            'fas fa-folder-open',
            'fas fa-undo',
            'fas fa-exclamation-triangle',
        ];

        return $iconos;
    }

    public function tipoModulo(): string
    {
        $tipoModulo = $this->tipo_modulo == 1 ? 'Contenedor' : 'Módulo';
        return $tipoModulo;
    }

    public function mostrarEstado(): string
    {
        $estado = $this->estado ? 'Activo' : 'Inactivo';
        return $estado;
    }

    public function mostrarVisible(): string
    {   
        $visible = $this->es_visible ? 'Sí' : 'No';
        return $visible;
    }

    public function colorEstado(): string
    {
        $color = $this->estado ? 'badge bg-success-light text-success' : 'badge bg-danger-light text-danger';
       
        return $color;
    }

    public function colorVisible(): string
    {
        $colorVisible = $this->es_visible ? 'badge badge-light text-success' : 'badge badge-light text-danger';
        return $colorVisible;
    }

    public function colorTipoModulo(): string
    {
        $colorTipoModulo = $this->tipo_modulo == 1 ? 'badge badge-light text-info' : 'badge badge-light text-warning';
        return $colorTipoModulo;
    }

     public function mostrarBotonActivarDesactivar(): string
    {
        $claseBtn = $this->estado ? 'btn btn-outline-danger btn-sm' : 'btn btn-outline-success btn-sm';
        return $claseBtn;
    }

    public function mostrarMensajeConfirmacion(): string
    {
        $mensaje = $this->estado ? '¿Está seguro que quiere desactivar el módulo?.' : '¿Está seguro que quiere activar el módulo?.';
        return $mensaje;
    }

    public function mostrarIcono(): string
    {
       $estado = $this->estado ? 'fas fa-ban' : 'fas fa-check';
        return $estado; 
    }
}
