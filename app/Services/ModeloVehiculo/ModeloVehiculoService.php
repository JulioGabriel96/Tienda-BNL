<?php

namespace App\Services\ModeloVehiculo;

use App\Models\ModeloVehiculo;

class ModeloVehiculoService 
{
    public function eliminarModelo(ModeloVehiculo $modeloVehiculo): bool
    {
        $modeloVehiculo->delete();
        return true;
    }
}
