<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $guarded = [];
 
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
}
