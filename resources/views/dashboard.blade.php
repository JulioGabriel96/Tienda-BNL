@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-speedometer2"></i> Bienvenido a Tienda BNL</h1>
            <p>Panel de control y gestión de tu tienda</p>
        </div>
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Marca
        </a>
    </div>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1">Total Marcas</p>
                        <h3 class="mb-0">{{ $totalMarcas }}</h3>
                    </div>
                    <div class="stat-icon bg-primary">
                        <i class="bi bi-tags"></i>
                    </div>
                </div>
                <small class="text-success"><i class="bi bi-arrow-up"></i> Sistema operativo</small>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1">Marcas Activas</p>
                        <h3 class="mb-0">{{ $marcasActivas }}</h3>
                    </div>
                    <div class="stat-icon bg-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <small class="text-success"><i class="bi bi-arrow-up"></i> Operativas</small>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1">Marcas Inactivas</p>
                        <h3 class="mb-0">{{ $marcasInactivas }}</h3>
                    </div>
                    <div class="stat-icon bg-warning">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                </div>
                <small class="text-warning"><i class="bi bi-arrow-down"></i> Pausadas</small>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1">Última Actualización</p>
                        <h3 class="mb-0">{{ $ultimaMarca ? $ultimaMarca->created_at->format('d/m') : 'N/A' }}</h3>
                    </div>
                    <div class="stat-icon bg-info">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                </div>
                <small class="text-info"><i class="bi bi-clock"></i> Reciente</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-list-ul"></i> Marcas Recientes</h5>
            </div>
            <div class="card-body">
                @if ($marcasRecientes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcasRecientes as $marca)
                                    <tr>
                                        <td>
                                            <strong>{{ $marca->nombre }}</strong>
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($marca->descripcion, 40) ?? 'Sin descripción' }}</small>
                                        </td>
                                        <td>
                                            @if ($marca->estado == 1)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Activa
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-x-circle"></i> Inactiva
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('marcas.edit', $marca->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">No hay marcas registradas aún</p>
                        <a href="{{ route('marcas.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Crear Primera Marca
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-lightning"></i> Acciones Rápidas</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('marcas.index') }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="bi bi-list"></i> Ver todas las marcas
                </a>
                <a href="{{ route('marcas.create') }}" class="btn btn-outline-success w-100 mb-2">
                    <i class="bi bi-plus-circle"></i> Agregar marca
                </a>
                <a href="#" class="btn btn-outline-info w-100">
                    <i class="bi bi-gear"></i> Configuración
                </a>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Sistema</h5>
            </div>
            <div class="card-body">
                <div class="info-item mb-3">
                    <small class="text-muted">Versión</small>
                    <p class="mb-0"><strong>1.0.0</strong></p>
                </div>
                <div class="info-item mb-3">
                    <small class="text-muted">Estado</small>
                    <p class="mb-0">
                        <span class="badge bg-success">
                            <i class="bi bi-circle-fill"></i> Online
                        </span>
                    </p>
                </div>
                <div class="info-item">
                    <small class="text-muted">Base de datos</small>
                    <p class="mb-0"><strong>MySQL</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(249, 250, 251, 0.95) 100%);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-icon.bg-primary {
        background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
    }

    .stat-icon.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-icon.bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .info-item {
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
</style>
@endsection
