<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaModelo;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
use App\Services\MarcaModelo\MarcaModeloService;
use App\Http\Requests\StoreMarcaModeloVehiculoRequest;
use App\Http\Requests\UpdateMarcaModeloVehiculoRequest;

 
class MarcaModeloVehiculosController extends Controller
{
    //
    public function index(Request $request, MarcaVehiculo $marcaVehiculo)
    { 
        $filtros = $request->only(['modelo_id', 'estado']);
        $modeloVehiculo = ModeloVehiculo::whereIn('id', $marcaVehiculo->marcas_modelos()->pluck('modelo_id'))->get();
        $modelosMarcaVehiculo = $marcaVehiculo->marcas_modelos()->with('modelo_vehiculo')->buscar($filtros)->latest()
            ->paginate(5)->withQueryString();

        
        return view('marcas-modelos.index', compact('modelosMarcaVehiculo', 'marcaVehiculo', 'modeloVehiculo'));
    }

    public function create(MarcaVehiculo $marcaVehiculo)
    {
        $modeloVehiculo = ModeloVehiculo::whereNotIn('id',MarcaModelo::pluck('modelo_id'))->get();
        return view('marcas-modelos.create', compact('marcaVehiculo', 'modeloVehiculo'));
    }

    public function store(StoreMarcaModeloVehiculoRequest $request, MarcaVehiculo $marcaVehiculo)
    {
       
        $validated = $request->validated();
        $marcaVehiculo->marcas_modelos()->create($validated);

        return redirect()->route('marcas-modelos.index', $marcaVehiculo)
        ->with('success', 'Modelo asociado a la marca creada exitosamente.');
    }

    public function show(MarcaModelo $modeloMarcaVehiculo)
    {
        $mensajeNotificacion = ($modeloMarcaVehiculo->estado == 0) ? '¿Está seguro que quiere activar el modelo asociado?.' : '¿Está seguro que quiere desactivar el modelo asociado?.';

        return view('marcas-modelos.show', compact('modeloMarcaVehiculo', 'mensajeNotificacion'));
    }

    public function edit(MarcaModelo $modeloMarcaVehiculo)
    {

        $modelosVehiculo = ModeloVehiculo::whereNotIn('id', MarcaModelo::where('id', '!=', $modeloMarcaVehiculo->id)->pluck('modelo_id'))->get();
        return view('marcas-modelos.edit', compact('modeloMarcaVehiculo', 'modelosVehiculo'));
    }

    public function update(UpdateMarcaModeloVehiculoRequest $request, MarcaModelo $modeloMarcaVehiculo)
    {
        $validated = $request->validated();
        $modeloMarcaVehiculo->update($validated);

        return redirect()
            ->route('marcas-modelos.index', $modeloMarcaVehiculo->marca_id)
            ->with('success', 'Modelo asociado modificado exitosamente.');
    }

    public function destroy(MarcaModelo $modeloMarcaVehiculo, MarcaModeloService $MarcaModeloService)
    {
        

        $MarcaModeloService->eliminarMarcaModelo($modeloMarcaVehiculo);

        $mensaje = ($modeloMarcaVehiculo->estado == 0) ? 'Modelo asociado desactivado exitosamente.' : 'Modelo asociado activado exitosamente.';
        $tipo = ($modeloMarcaVehiculo->estado == 0) ? 'error' : 'success';

        return redirect()
        ->route('marcas-modelos.index', $modeloMarcaVehiculo->marca_id)
        ->with($tipo, $mensaje);
    }

}
