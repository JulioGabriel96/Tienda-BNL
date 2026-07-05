<?php

namespace App\Services\TipoCliente;

use App\Models\TipoCliente;
use Illuminate\Support\Facades\Schema;

class TipoClienteService
{
    public function eliminarTipoCliente(TipoCliente $tipoCliente): bool
    {
        if ($tipoCliente->clientes()->exists()) {
            return false;
        }

        $tipoCliente->delete();

        return true;
    }
}
