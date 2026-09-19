@extends('layouts.app')

@section('title', 'Gestionar Clientes   ')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo Cliente
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('clientes.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="buscar">Nombre</label>
                                <input type="text" class="form-control"
                                       id="nombre" name="nombre" value="{{ request('nombre') }}"
                                       placeholder="Nombre del Cliente">
                            </div>
                        </div> 

                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="buscar">Apellido</label>
                                <input type="text" class="form-control"
                                       id="apellido" name="apellido" value="{{ request('apellido') }}"
                                       placeholder="Apellido del Cliente">
                            </div>
                        </div> 

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="marca_id">Género</label>
                                <select class="form-control" id="genero_id" name="genero_id">
                                    <option value="">Todas</option>
                                    @foreach ($generos as $genero)
                                        <option value="{{ $genero->id }}"
                                            {{ request('genero_id') == $genero->id ? 'selected' : '' }}>
                                            {{ $genero->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="categoria_id">Tipo Cliente</label>
                                <select class="form-control" id="tipo_cliente_id" name="tipo_cliente_id">
                                    <option value="">Todas</option>
                                    @foreach ($tipoCliente as $tipoCliente)
                                        <option value="{{ $tipoCliente->id }}"
                                                {{ request('tipo_cliente_id') == $tipoCliente->id ? 'selected' : '' }}>
                                            {{ $tipoCliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                            <br>
                        </div>


                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-eraser"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Lista de Clientes</h5>
                <div class="card-tools">Total de registros: {{ $clientes->total() }}</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th >Email</th>
                            <th>Télefono</th>
                            <th>Dirección</th>
                            <th>Fecha Nac.</th>
                            <th>Género</th>
                            <th>Tipo Cliente</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }},  {{ $cliente->apellido }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>{{ $cliente->fecha_nacimiento }}</td>
                                <td>{{ $cliente->genero?->nombre }}</td>
                                <td>{{ $cliente->tipoCliente?->nombre }}</td>
                                <td> 
                                    <span class="badge {{ $cliente->estado ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                                    </span> 
                                </td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('clientes.show', $cliente) }}"
                                       class="btn btn-outline-info btn-sm"
                                       title="Ver Cliente">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                       class="btn btn-outline-warning btn-sm"
                                       title="Editar Cliente">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('clientes.destroy', $cliente) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de que desea eliminar este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar cliente">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No se encontraron clientes con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($clientes->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <span class="text-muted small">
                        Mostrando {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} de {{ $clientes->total() }} registros
                    </span>
                    <div>{{ $clientes->links() }}</div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .filter-actions {
        display: flex;
        gap: 0.5rem;
    }

    .filter-actions .btn {
        flex: 1 1 0;
    }
</style>
@endsection
