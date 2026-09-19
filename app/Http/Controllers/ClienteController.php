<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Genero;
use App\Models\TipoCliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\Cliente\ClienteService;

class ClienteController extends Controller
{ 
    public function index(Request $request)
    {
        $filtros = $request->only(['nombre', 'apellido', 'estado', 'genero_id', 'tipo_cliente_id']);
        $clientes = Cliente::with(['genero', 'tipoCliente'])
            ->buscar($filtros)
            ->latest()
            ->paginate(5) 
            ->withQueryString();
        $generos = Genero::orderBy('nombre')->get();
        $tipoCliente = TipoCliente::orderBy('nombre')->get();
        return view('clientes.index', compact('clientes', 'generos', 'tipoCliente'));
    }

    public function create()
    {
        $generos = Genero::orderBy('nombre')->get();
        $tipoCliente = TipoCliente::orderBy('nombre')->get();
        return view('clientes.create', compact('generos', 'tipoCliente'));
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->validated());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }


    public function edit(Cliente $cliente)
    {
        $generos = Genero::orderBy('nombre')->get();
        $tipoCliente = TipoCliente::orderBy('nombre')->get();
        return view('clientes.edit', compact('cliente', 'generos', 'tipoCliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $validated = $request->validated();
        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function destroy(Cliente $cliente, ClienteService $clienteService)
    {
        $permitirEliminar = $clienteService->eliminarCliente($cliente);
        if (!$permitirEliminar) {
            $mensaje='No se puede eliminar el cliente porque tiene ventas asociadas.';
            $tipo='error';
        }else{
            $mensaje='Cliente eliminado exitosamente.';
            $tipo='success';
        }
        return redirect()->route('clientes.index')->with($tipo, $mensaje);
    }
}
