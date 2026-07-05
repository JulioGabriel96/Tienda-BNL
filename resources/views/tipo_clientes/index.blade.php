@extends('layouts.app')

@section('title', 'Gestionar Tipos de Clientes')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('tipo-clientes.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo Tipo de Cliente
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('tipo-clientes.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-md-0">
                                <label for="nombre">Nombre del tipo de cliente</label>
                                <input type="text"
                                       class="form-control"
                                       id="nombre"
                                       name="nombre"
                                       value="{{ request('nombre') }}"
                                       placeholder="Buscar por nombre">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('tipo-clientes.index') }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="bi bi-table"></i> Lista de Tipos de Clientes</h5>
                <div class="card-tools">
                    Total de registros: <span>{{ $tiposClientes->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-light">
                            <th><i class="bi bi-person-badge"></i> Nombre</th>
                            <th><i class="bi bi-percent"></i> Descuento</th>
                            <th><i class="bi bi-info-circle"></i> Estado</th>
                            <th class="text-center"><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tiposClientes as $tipoCliente)
                            <tr>
                                <td><strong>{{ $tipoCliente->nombre }}</strong></td>
                                <td>{{ $tipoCliente->descuento }}%</td>
                                <td>
                                    @if ($tipoCliente->estado)
                                        <span class="badge bg-success-light text-success">
                                            <i class="bi bi-check-circle"></i> Activo
                                        </span>
                                    @else
                                        <span class="badge bg-warning-light text-warning">
                                            <i class="bi bi-x-circle"></i> Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('tipo-clientes.show', $tipoCliente) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tipo-clientes.edit', $tipoCliente) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ route('tipo-clientes.destroy', $tipoCliente) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Está seguro de que desea eliminar este tipo de cliente?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                    title="Eliminar registro">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No se encontraron tipos de clientes con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($tiposClientes->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $tiposClientes->firstItem() }} a {{ $tiposClientes->lastItem() }} de {{ $tiposClientes->total() }} registros
                    </div>
                    <div class="pagination-wrapper ml-auto">
                        {{ $tiposClientes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table th {
        background-color: #f9fafb;
        border-color: #e5e7eb;
        color: #374151;
        font-weight: 600;
        padding: 1rem;
    }

    .table td {
        border-color: #e5e7eb;
        padding: 1rem;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
    }

    .bg-success-light {
        background-color: #ecfdf5 !important;
    }

    .bg-warning-light {
        background-color: #fef3c7 !important;
    }

    .text-success {
        color: #10b981 !important;
    }

    .text-warning {
        color: #f59e0b !important;
    }

    .action-buttons {
        display: inline-flex;
        gap: 0.4rem;
    }

    .action-buttons .btn {
        align-items: center;
        display: inline-flex;
        height: 34px;
        justify-content: center;
        width: 38px;
    }

    .filter-actions {
        display: flex;
        gap: 0.5rem;
    }

    .filter-actions .btn {
        flex: 1 1 0;
    }

    .pagination-wrapper nav,
    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }
</style>
@endsection
