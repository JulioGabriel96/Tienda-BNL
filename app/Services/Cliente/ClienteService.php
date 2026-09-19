<?php

namespace App\Services\Cliente;
use App\Models\Cliente;
use Illuminate\Support\Facades\Schema;


class ClienteService
{
    public function eliminarCliente(Cliente $cliente): bool
    {
        if (Schema::hasTable('ventas') && Schema::hasColumn('ventas', 'cliente_id') &&
 $cliente->ventas()->exists()) 
        {
            return false;
        }

        $cliente->delete();
        return true;
    }
}


