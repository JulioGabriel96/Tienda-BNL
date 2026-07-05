@extends('layouts.app')

@section('title', 'Subcategorias de ' . $categoria->nombre)

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div>
                    <h5 class="mb-0">
                        <i class="fas fa-sitemap"></i> Subcategorias de {{ $categoria->nombre }}
                    </h5>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('subcategorias.create', $categoria) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nueva subcategoria
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('subcategorias.index', $categoria) }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-md-0">
                                <label for="nombre">Nombre de la subcategoria</label>
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
                                <a href="{{ route('subcategorias.index', $categoria) }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="fas fa-list"></i> Lista de subcategorias</h5>
                <div class="card-tools">
                    Total de registros: <span>{{ $subcategorias->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subcategorias as $subcategoria)
                            <tr>
                                <td><strong>{{ $subcategoria->nombre }}</strong></td>
                                <td>
                                    <small class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($subcategoria->descripcion, 70) ?: 'Sin descripcion' }}
                                    </small>
                                </td>
                                <td>
                                    @if ($subcategoria->estado)
                                        <span class="badge bg-success-light text-success">
                                            <i class="fas fa-check-circle"></i> Activa
                                        </span>
                                    @else
                                        <span class="badge bg-warning-light text-warning">
                                            <i class="fas fa-times-circle"></i> Inactiva
                                        </span>
                                    @endif 
                                </td>

                                <td class="text-left">
                                    <div class="action-buttons">
                                        <a href="{{ route('subcategorias.show', $subcategoria->id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('subcategorias.edit', $subcategoria->id) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>                                        
                                        <form method="POST"
                                              action="{{ route('subcategorias.destroy', $subcategoria->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Estas seguro de que deseas eliminar esta subcategoría?');">
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
                                <td colspan="3" class="text-center text-muted py-4">
                                    No se encontraron subcategorias para esta categoria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($subcategorias->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $subcategorias->firstItem() }} a {{ $subcategorias->lastItem() }}
                        de {{ $subcategorias->total() }} registros
                    </div>
                    <div class="pagination-wrapper ml-auto">
                        {{ $subcategorias->links() }}
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
        vertical-align: middle;
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
