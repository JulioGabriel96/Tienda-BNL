<?php

namespace App\Services\Genero;

use App\Models\Genero;
use Illuminate\Support\Facades\Schema;

class GeneroService
{
    public function eliminarGenero(Genero $genero): bool
    {
        if ($genero->clientes()->exists()) {
            return false;
        }

        $genero->delete();

        return true;
    }
}
