<?php

namespace App\Services\Producto;

use App\Models\Producto;
use Illuminate\Support\Facades\Schema;

class ProductoService
{
    public function eliminarProducto(Producto $producto): bool
    {
        if (Schema::hasTable('ventas_detalle') && $producto->ventasDetalles()->exists()) {
            return false;
        }

        return (bool) $producto->delete();
    }
}
