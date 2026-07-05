<?php

namespace App\Services\Categoria;
use App\Models\Categoria;

class CategoriaService
{
    public function eliminarCategoria(Categoria $categoria): bool
    {
        if($categoria->subcategorias()->exists()) {
            // Si la categoría tiene subcategorías, no se puede eliminar
            return false;
        }

        $categoria->delete();
        return true;
    }
}

?>