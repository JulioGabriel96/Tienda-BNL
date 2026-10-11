@extends('layouts.app')

@section('title', 'Ver Modelo: ' . $modeloMarcaVehiculo->modelo_vehiculo->nombre)

@section('app_content')
<div class="page-header mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <p>Modelo Asociado a la marca {{ $modeloMarcaVehiculo->marca_vehiculo->nombre }}</p>
            <h1><i class="bi bi-tag"></i> {{ $modeloMarcaVehiculo->modelo_vehiculo->nombre }}</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('marcas-modelos.edit', $modeloMarcaVehiculo->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('marcas-modelos.index', $modeloMarcaVehiculo->marca_id) }}" class="btn btn-secondary">
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
                    <code class="text-dark">{{ $modeloMarcaVehiculo->id }}</code>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Modelo</small>
                    <code class="text-dark">{{ $modeloMarcaVehiculo->modelo_vehiculo->nombre }}</code>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Marca</small>
                    <code class="text-dark">{{ $modeloMarcaVehiculo->marca_vehiculo->nombre }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creada</small>
                    <strong>{{ $modeloMarcaVehiculo->created_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $modeloMarcaVehiculo->created_at->format('H:i:s') }}</small>
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $modeloMarcaVehiculo->updated_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $modeloMarcaVehiculo->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
      

        <!-- Acciones Card -->
        <div class="card border-danger">
            <div class="card-header border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Gestión de estado.</h5>
            </div>

            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> {{ $mensajeNotificacion }}
                </p>
                <form method="POST" action="{{ route('marcas-modelos.destroy', $modeloMarcaVehiculo->id) }}" style="display:inline;"
                      onsubmit="return confirm('⚠️ {{ $mensajeNotificacion }}');">
                    @csrf
                    @method('DELETE')
                    @if($modeloMarcaVehiculo->estado == 0)
                    <button type="submit" class="btn btn-success">
                        Activar Modelo
                    </button>
                    @else
                    <button type="submit" class="btn btn-danger">
                        Desactivar Modelo
                    </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

