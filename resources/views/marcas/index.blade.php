@extends('layouts.app')

@section('title', 'Gestionar Marcas')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('marcas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nueva Marca
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('marcas.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-md-0">
                                <label for="nombre">Nombre de la marca</label>
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
                                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activa</option>
                                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactiva</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="bi bi-table"></i> Lista de Marcas</h5>
                <div class="card-tools"> Total de registros:
                    <span>{{ $marcas->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-light">
                            <th><i class="bi bi-tag"></i> Nombre</th>
                            <th><i class="bi bi-file-text"></i> Descripción</th>
                            <th><i class="bi bi-info-circle"></i> Estado</th>
                            <th class="text-center"><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($marcas as $marca)
                            <tr>
                                <td>
                                    <strong>{{ $marca->nombre }}</strong>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($marca->descripcion, 50) ?? 'Sin descripcion' }}</small>
                                </td>
                                <td>
                                    @if ($marca->estado == 1)
                                        <span class="badge bg-success-light text-success">
                                            <i class="bi bi-check-circle"></i> Activa
                                        </span>
                                    @else
                                        <span class="badge bg-warning-light text-warning">
                                            <i class="bi bi-x-circle"></i> Inactiva
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('marcas.show', $marca->id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('marcas.edit', $marca->id) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ route('marcas.destroy', $marca->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Estas seguro de que deseas eliminar esta marca?');">
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
                                    No se encontraron marcas con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($marcas->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $marcas->firstItem() }} a {{ $marcas->lastItem() }} de {{ $marcas->total() }} registros
                    </div>

                    <div class="pagination-wrapper ml-auto">
                        {{ $marcas->links() }}
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
        text-transform: none;
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

    .text-success {
        color: #10b981 !important;
    }

    .bg-warning-light {
        background-color: #fef3c7 !important;
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
        font-size: 0.875rem;
        height: 34px;
        justify-content: center;
        padding: 0.375rem 0.75rem;
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

    .pagination-wrapper .page-link {
        color: #007bff;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
@endsection
