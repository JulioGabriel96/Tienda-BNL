<?php

namespace App\Services\MarcaVehiculo;

use App\Models\MarcaVehiculo;

class MarcaVehiculoService 
{
    public function eliminarMarca(MarcaVehiculo $marcaVehiculo): bool
    {
        $marcaVehiculo->delete();

        return true;
    }
}
