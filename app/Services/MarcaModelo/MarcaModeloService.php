<?php

namespace App\Services\MarcaModelo;

use App\Models\MarcaModelo;

class MarcaModeloService 
{
    public function eliminarMarcaModelo(MarcaModelo $marcaModelo): bool
    {
        $estado = ($marcaModelo->estado == 0) ? true : false;

        $marcaModelo->update(['estado' => $estado]);
        return true;
    } 
}
