<?php

namespace App\Services\Modulo;

use App\Models\Modulo;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ModuloService
{
    public function gestionarEstado(Modulo $modulo): bool
    {

        // recupero el tipo de modulo
        $tipoModulo = $modulo->tipo_modulo;
        $registro = $modulo->id;
        $nuevoEstado = !$modulo->estado;

        try {
            
            DB::beginTransaction();
            $modulo->estado = $nuevoEstado;
            $modulo->save();

            if($tipoModulo == 1)
            {
                // realizo inactivacion a todos los hijos
                $modificacion = Modulo::where('rela_padre', $registro)
                ->update(['estado' => $nuevoEstado]);
            }

            $return = true;
            DB::commit();
                        
        } catch (\Throwable $th) {
            $return = false;
            report($th);
            DB::rollBack();
        }

        return $return;
    }

    public function validarContenedoresConHijos(Modulo $modulo, int $tipoModulo): bool
    {
        ## obtengo el tipo de modulo actual
        $moduloActual = $modulo->tipo_modulo;

        # si el modulo actual es contenedor y se quiere cambiar a modulo, valido si tiene hijos
        if($moduloActual == 1 && $tipoModulo == 2)
        {
            # consulto si el contenedor tiene hijos
            $tieneHijos = Modulo::where('rela_padre', $modulo->id)->exists();
           
            if($tieneHijos)
            {
               return false;
            }
        }
        return true;
    }

    public function actualizarModulo(Modulo $modulo, array $data): void
    {

        $tipoModulo = $data['tipo_modulo'];
        #verifico si el modulo es contenedor y se quiere cambiar a modulo, tiene hijos
        $permitirModificar = $this->validarContenedoresConHijos($modulo, $tipoModulo);

        # si es diferente a false muestro el mensaje
        if(!$permitirModificar)
        {
            throw ValidationException::withMessages([
                'tipo_modulo' => 'No es posible realizar la modificación ya que el contenedor tiene módulos hijos asociados.'
            ]);
        }

        #realizo modificacion
        $modulo->update($data);
    }
}
