<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoClienteRequest;
use App\Http\Requests\UpdateTipoClienteRequest;
use App\Models\TipoCliente;
use App\Services\TipoCliente\TipoClienteService;
use Illuminate\Http\Request;

class TipoClienteController extends Controller
{ 
    public function index(Request $request)
    {
        $filtros = $request->only(['nombre', 'estado']);
        $tiposClientes = TipoCliente::buscar($filtros)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('tipo_clientes.index', compact('tiposClientes'));
    }

    public function create()
    {
        return view('tipo_clientes.create');
    }

    public function store(StoreTipoClienteRequest $request)
    {
        $validated = $request->validated();
        $validated['estado'] = $validated['estado'] ?? 1;

        TipoCliente::create($validated);

        return redirect()
            ->route('tipo-clientes.index')
            ->with('success', 'Tipo de cliente creado exitosamente.');
    }

    public function show(TipoCliente $tipoCliente)
    {
        return view('tipo_clientes.show', compact('tipoCliente'));
    }

    public function edit(TipoCliente $tipoCliente)
    {
        return view('tipo_clientes.edit', compact('tipoCliente'));
    }

    public function update(UpdateTipoClienteRequest $request, TipoCliente $tipoCliente)
    {
        $validated = $request->validated();
        $validated['estado'] = $validated['estado'] ?? 1;

        $tipoCliente->update($validated);
 
        return redirect()
            ->route('tipo-clientes.index')
            ->with('success', 'Tipo de cliente actualizado exitosamente.');
    }
 
    public function destroy(TipoCliente $tipoCliente, TipoClienteService $tipoClienteService)
    {
        $permitirEliminar = $tipoClienteService->eliminarTipoCliente($tipoCliente);

        if (! $permitirEliminar) {
            $mensaje = 'No se puede eliminar el tipo de cliente porque está asociado a uno o más clientes.';
            $tipo = 'error';
        } else {
            $mensaje = 'Tipo de cliente eliminado exitosamente.';
            $tipo = 'success';
        }

        return redirect()
            ->route('tipo-clientes.index')
            ->with($tipo, $mensaje);
    }
}
