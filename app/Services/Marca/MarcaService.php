<?php

namespace App\Services\Marca;

use App\Models\Marca;

class MarcaService
{
    public function eliminarMarca(Marca $marca): bool
    {
        if ($marca->productos()->exists()) {
            return false;
        }

        $marca->delete();

        return true;
    }
}
