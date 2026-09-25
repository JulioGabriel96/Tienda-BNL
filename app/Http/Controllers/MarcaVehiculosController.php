<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaVehiculoRequest;
use App\Http\Requests\UpdateMarcaVehiculoRequest;
use App\Models\MarcaVehiculo;  
use App\Services\MarcaVehiculo\MarcaVehiculoService;
use Illuminate\Http\Request;

 
class MarcaVehiculosController extends Controller
{
    public function index(Request $request)
    {
        $filtros = $request->only(['nombre']);
        $marcasVehiculo = MarcaVehiculo::buscar($filtros)->latest()
            ->paginate(5)->withQueryString();

        return view('marcas-vehiculos.index', compact('marcasVehiculo'));
    }
 
    /*
     * muestra el formulario para crear una nueva marca
    */
    public function create()
    {
        return view('marcas-vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaVehiculoRequest $request)
    {
        $validated = $request->validated();
        MarcaVehiculo::create($validated);

        return redirect()->route('marcas-vehiculos.index')->with('success', 'Marca de vehículo creada exitosamente.');
    }

    /**
     * mostrar el recurso especificado.
     */
    public function show(MarcaVehiculo $marcaVehiculo)
    {
        return view('marcas-vehiculos.show', compact('marcaVehiculo'));
    }

    /**
     * mostrarmos el formulario para editar el recurso especificado.
     */
    public function edit(MarcaVehiculo $marcaVehiculo)
    {
        return view('marcas-vehiculos.edit', compact('marcaVehiculo'));
    }

    /**
     * modificar el recurso especificado en almacenamiento.
     */
    public function update(UpdateMarcaVehiculoRequest $request, MarcaVehiculo $marcaVehiculo)
    {
        $validated = $request->validated();

        $marcaVehiculo->update($validated);
        // dd($marcasVehiculo);

        return redirect()->route('marcas-vehiculos.index')->with('success', 'Marca de vehículo actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarcaVehiculo $marcaVehiculo, MarcaVehiculoService $MarcaVehiculoService)
    {
        $MarcaVehiculoService->eliminarMarca($marcaVehiculo);
        $mensaje = 'Marca de vehículo eliminada exitosamente.';
        $tipo = 'success';
        return redirect()->route('marcas-vehiculos.index')->with($tipo, $mensaje);
    }
}
