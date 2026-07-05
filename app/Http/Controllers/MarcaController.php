<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use App\Services\Marca\MarcaService;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // dd($filtros->all());
        $filtros = $request->only(['nombre', 'estado']);
        $marcas = Marca::buscar($filtros)->latest()
            ->paginate(5)->withQueryString();

        return view('marcas.index', compact('marcas'));
    }

    /*
     * muestra el formulario para crear una nueva marca
    */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaRequest $request)
    {
        $validated = $request->validated();
        $validated['estado'] = $validated['estado'] ?? 1;

        Marca::create($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca creada exitosamente.');
    }

    /**
     * mostrar el recurso especificado.
     */
    public function show(Marca $marca)
    {
        return view('marcas.show', compact('marca'));
    }

    /**
     * mostrarmos el formulario para editar el recurso especificado.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * modificar el recurso especificado en almacenamiento.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        $validated = $request->validated();
        $validated['estado'] = $validated['estado'] ?? 1;

        $marca->update($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca, MarcaService $marcaService)
    {
        $permitirEliminar = $marcaService->eliminarMarca($marca);

        if (! $permitirEliminar) {
            $mensaje = 'No se puede eliminar la marca porque está asociada a uno o más productos.';
            $tipo = 'error';
        } else {
            $mensaje = 'Marca eliminada exitosamente.';
            $tipo = 'success';
        }

        return redirect()->route('marcas.index')->with($tipo, $mensaje);
    }
}
