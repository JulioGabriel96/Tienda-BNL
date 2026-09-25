@extends('layouts.app')

@section('title', 'Ver Marca: ' . $marcaVehiculo->nombre)

@section('app_content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-tag"></i> {{ $marcaVehiculo->nombre }}</h1>
            <p>Detalles completos de la marca</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('marcas-vehiculos.edit', $marcaVehiculo) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('marcas-vehiculos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">


        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Información</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">ID</small>
                    <code class="text-dark">{{ $marcaVehiculo->id }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creada</small>
                    <strong>{{ $marcaVehiculo->created_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $marcaVehiculo->created_at->format('H:i:s') }}</small>
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $marcaVehiculo->updated_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $marcaVehiculo->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
      

        <!-- Acciones Card -->
        <div class="card border-danger">
            <div class="card-header border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Zona de Peligro</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> Una vez eliminada, esta marca de vehículo no podrá ser recuperada.
                </p>
                <form method="POST" action="{{ route('marcas-vehiculos.destroy', $marcaVehiculo->id) }}" style="display:inline;"
                      onsubmit="return confirm('⚠️ ¿Estás completamente seguro de que deseas eliminar esta marca? Esta acción no se puede deshacer.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Marca Permanentemente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    code {
        background-color: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .border-danger {
        border: 2px solid #ef4444;
    }
</style>
@endsection

