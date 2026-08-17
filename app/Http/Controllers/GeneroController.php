<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Services\Genero\GeneroService;
use App\Models\Genero;
use Illuminate\Http\Request;



class GeneroController extends Controller
{
    //
    public function index(Request $request)
    { 
        $filtros = $request->only(['nombre']);
        $generos = Genero::buscar($filtros)
            ->latest()
            ->paginate(5)
            ->withQueryString();
        return view('generos.index', compact('generos'));
    }

    public function create()
    {
        return view('generos.create');
    }

    public function store(StoreGeneroRequest $request) 
    {
        // Validar y guardar el género
        // ...
        $validated = $request->validated();
        Genero::create($validated);

        return redirect()
        ->route('generos.index')
        ->with('success', 'Género creado exitosamente.');
    }

    public function edit(Genero $genero)
    {
        // Mostrar formulario de edición del género
        // ...
        return view('generos.edit', compact('genero'));
    }

    public function update(UpdateGeneroRequest $request, Genero $genero)
    {
        // Validar y actualizar el género
        // ...
        $validated = $request->validated();
        $genero->update($validated);

        return redirect()
            ->route('generos.index')
            ->with('success', 'Género actualizado exitosamente.');
    }

    public function show(Genero $genero)
    {
        return view('generos.show', compact('genero'));
    }

    public function destroy(Genero $genero, GeneroService $generoService)
    {
        // Eliminar el género
        $permitirEliminar = $generoService->eliminarGenero($genero);

        if(!$permitirEliminar) {
            $mensaje='No se puede eliminar el género porque tiene clientes asociados.';
            $tipo='error';
        }else{
            $mensaje='Género eliminado exitosamente.';
            $tipo='success';
        }

        return redirect()
            ->route('generos.index')
            ->with($tipo, $mensaje);
    }
}
