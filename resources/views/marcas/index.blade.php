@extends('layouts.app')

@section('title', 'Gestionar Marcas')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-tags"></i> Gestión de Marcas</h1>
            <p>Administra todas las marcas de tu tienda</p>
        </div>
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Marca
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        @if ($marcas->count() > 0)
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-table"></i> Lista de Marcas</h5>
                    <span class="badge bg-primary">{{ $marcas->total() }} marcas</span>
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
                            @foreach ($marcas as $marca)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm rounded-circle bg-gradient me-3"
                                                 style="background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ strtoupper(substr($marca->nombre, 0, 1)) }}
                                            </div>
                                            <strong>{{ $marca->nombre }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ Str::limit($marca->descripcion, 50) ?? 'Sin descripción' }}</small>
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
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('marcas.show', $marca->id) }}" 
                                               class="btn btn-outline-info" 
                                               title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('marcas.edit', $marca->id) }}" 
                                               class="btn btn-outline-warning" 
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('marcas.destroy', $marca->id) }}" 
                                                  style="display:inline;"
                                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta marca?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $marcas->links() }}
            </div>
        @else
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
                    <h5 class="mt-4 mb-2">No hay marcas registradas</h5>
                    <p class="text-muted mb-4">Comienza creando tu primera marca para gestionar tu catálogo</p>
                    <a href="{{ route('marcas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primera Marca
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .table th {
        background-color: #f9fafb;
        border-color: #e5e7eb;
        font-weight: 600;
        color: #374151;
        text-transform: none;
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
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
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

    .btn-group-sm .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
@endsection
