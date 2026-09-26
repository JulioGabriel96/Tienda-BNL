<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreModeloVehiculoRequest;
use App\Http\Requests\UpdateModeloVehiculoRequest;
use App\Models\ModeloVehiculo;
use App\Services\ModeloVehiculo\ModeloVehiculoService;


class ModeloVehiculosController extends Controller
{
    //
    public function index(Request $request)
    {
        $filtros = $request->only(['nombre']);
        $modelosVehiculo = ModeloVehiculo::buscar($filtros)->latest()
            ->paginate(5)->withQueryString();

        return view('modelos-vehiculos.index', compact('modelosVehiculo'));
    }

    public function create()
    {
        return view('modelos-vehiculos.create');
    }

    public function store(StoreModeloVehiculoRequest $request)
    {
        $validated = $request->validated();
        ModeloVehiculo::create($validated);

        return redirect()->route('modelos-vehiculos.index')->with('success', 'Modelo de vehículo creado exitosamente.');
    }

     public function show(ModeloVehiculo $modeloVehiculo)
    {
        return view('modelos-vehiculos.show', compact('modeloVehiculo'));
    }

    /**
     * mostrarmos el formulario para editar el recurso especificado.
     */
    public function edit(ModeloVehiculo $modeloVehiculo)
    {
        return view('modelos-vehiculos.edit', compact('modeloVehiculo'));
    }

    public function update(UpdateModeloVehiculoRequest $request, ModeloVehiculo $modeloVehiculo)
    {
        $validated = $request->validated();
        $modeloVehiculo->update($validated);

        return redirect()->route('modelos-vehiculos.index')->with('success', 'Modelo de vehículo actualizado exitosamente.');
    }

    public function destroy(ModeloVehiculo $modeloVehiculo, ModeloVehiculoService $modeloVehiculoService)
    {
        $modeloVehiculoService->eliminarModelo($modeloVehiculo);
        return redirect()->route('modelos-vehiculos.index')->with('success', 'Modelo de vehículo eliminado exitosamente.');
    }

} 
