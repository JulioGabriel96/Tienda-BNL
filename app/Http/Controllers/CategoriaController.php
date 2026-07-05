<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Services\Categoria\CategoriaService;
use App\Models\Categoria;


class CategoriaController extends Controller
{ 
    //
    public function index(Request $request)
    { 
        $filtros = $request->only(['nombre', 'estado']);
        $categorias = Categoria::buscar($filtros)->withCount('subcategorias')
        ->latest()
        ->paginate(5)->withQueryString();
        return view('categorias.index', compact('categorias'));

    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        $validated = $request->validated();
        $validated['estado'] = $validated['estado'] ?? 1;
        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $validated = $request->validated();
        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria, CategoriaService $categoriaService)
    {
        $permitirEliminar = $categoriaService->eliminarCategoria($categoria);
        //dd($permitirEliminar);
        if (!$permitirEliminar) {
            $mensaje='No se puede eliminar la categoría porque tiene subcategorías asociadas.';
            $tipo='error';
        }else{
            $mensaje='Categoría eliminada exitosamente.';
            $tipo='success';
        }
        return redirect()->route('categorias.index')->with($tipo, $mensaje);
    }

    



}
