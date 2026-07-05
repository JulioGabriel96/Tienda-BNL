<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubCategoriaRequest;
use App\Http\Requests\UpdateSubCategoriaRequest;
use App\Models\SubCategoria;
use App\Models\Categoria;

class SubCategoriaController extends Controller
{
    public function index(Request $request, Categoria $categoria)
    {
        $filtros = $request->only(['nombre', 'estado']);
        $subcategorias = $categoria->subcategorias()->buscar($filtros)->latest()
            ->paginate(5)->withQueryString();
        return view('subcategorias.index', compact('subcategorias', 'categoria'));
    }

    public function create(Categoria $categoria)
    {
        return view('subcategorias.create', compact('categoria'));
    }

    public function store(StoreSubCategoriaRequest $request, Categoria $categoria)
    {
       
        $validated = $request->validated();
        $categoria->subcategorias()->create($validated);

        return redirect()
            ->route('subcategorias.index', $categoria)
            ->with('success', 'Subcategoria creada exitosamente.');
    }

    public function show(SubCategoria $subcategoria)
    {
        return view('subcategorias.show', compact('subcategoria'));
    }

    public function edit(SubCategoria $subcategoria)
    {
        return view('subcategorias.edit', compact('subcategoria'));
    }

    public function update(UpdateSubCategoriaRequest $request, SubCategoria $subcategoria)
    {
        $validated = $request->validated();
        $subcategoria->update($validated);

        return redirect()
            ->route('subcategorias.index', $subcategoria->categoria)
            ->with('success', 'Subcategoría actualizada exitosamente.');
    }

    public function destroy(SubCategoria $subcategoria)
    {
        $subcategoria->delete();

        return redirect()
            ->route('subcategorias.index', $subcategoria->categoria)
            ->with('success', 'Subcategoría eliminada exitosamente.');
    }
}
