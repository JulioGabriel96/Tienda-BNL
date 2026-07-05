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

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
