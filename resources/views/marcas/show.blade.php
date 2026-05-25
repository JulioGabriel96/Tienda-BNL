@extends('layouts.app')

@section('title', 'Ver Marca: ' . $marca->nombre)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-tag"></i> {{ $marca->nombre }}</h1>
            <p>Detalles completos de la marca</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('marcas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <!-- Estado Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Estado de la Marca</h5>
            </div>
            <div class="card-body text-center py-4">
                @if ($marca->estado == 1)
                    <div style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="mb-2" style="color: #10b981;">Marca Activa</h4>
                    <p class="text-muted small">Esta marca está visible en el catálogo</p>
                @else
                    <div style="font-size: 3rem; color: #f59e0b; margin-bottom: 1rem;">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </div>
                    <h4 class="mb-2" style="color: #f59e0b;">Marca Inactiva</h4>
                    <p class="text-muted small">Esta marca no es visible en el catálogo</p>
                @endif
            </div>
        </div>

        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Información</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">ID</small>
                    <code class="text-dark">{{ $marca->id }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creada</small>
                    <strong>{{ $marca->created_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $marca->created_at->format('H:i:s') }}</small>
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $marca->updated_at->format('d/m/Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $marca->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Descripción Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Descripción</h5>
            </div>
            <div class="card-body">
                @if ($marca->descripcion)
                    <p class="mb-0" style="line-height: 1.6;">{{ $marca->descripcion }}</p>
                @else
                    <p class="text-muted mb-0">
                        <i class="bi bi-info-circle"></i> Esta marca no tiene descripción
                    </p>
                @endif
            </div>
        </div>

        <!-- Acciones Card -->
        <div class="card border-danger">
            <div class="card-header bg-danger bg-opacity-10 border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Zona de Peligro</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> Una vez eliminada, esta marca no podrá ser recuperada.
                </p>
                <form method="POST" action="{{ route('marcas.destroy', $marca->id) }}" style="display:inline;"
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

    .bg-opacity-10 {
        opacity: 0.1;
    }

    .border-danger {
        border: 2px solid #ef4444;
    }
</style>
@endsection
