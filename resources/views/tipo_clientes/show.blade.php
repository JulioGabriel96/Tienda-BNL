@extends('layouts.app')

@section('title', 'Ver Tipo de Cliente: ' . $tipoCliente->nombre)

@section('app_content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-person-badge"></i> {{ $tipoCliente->nombre }}</h1>
            <p>Detalles completos del tipo de cliente</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('tipo-clientes.edit', $tipoCliente) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('tipo-clientes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Estado</h5>
            </div>
            <div class="card-body text-center py-4">
                @if ($tipoCliente->estado)
                    <div style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="mb-2" style="color: #10b981;">Tipo de Cliente Activo</h4>
                @else
                    <div style="font-size: 3rem; color: #f59e0b; margin-bottom: 1rem;">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </div>
                    <h4 class="mb-2" style="color: #f59e0b;">Tipo de Cliente Inactivo</h4>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Información</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">ID</small>
                    <code class="text-dark">{{ $tipoCliente->id }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creado</small>
                    <strong>{{ $tipoCliente->created_at->format('d/m/Y') }}</strong><br>
                    <small class="text-muted">{{ $tipoCliente->created_at->format('H:i:s') }}</small>
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $tipoCliente->updated_at->format('d/m/Y') }}</strong><br>
                    <small class="text-muted">{{ $tipoCliente->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-percent"></i> Descuento</h5>
            </div>
            <div class="card-body text-center py-5">
                <div class="display-4 text-primary font-weight-bold">
                    {{ $tipoCliente->descuento }}%
                </div>
                <p class="text-muted mb-0">Descuento asignado a este tipo de cliente</p>
            </div>
        </div>

        <div class="card border-danger">
            <div class="card-header border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Zona de Peligro</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> Una vez eliminado, este tipo de cliente no podrá ser recuperado.
                </p>
                <form method="POST"
                      action="{{ route('tipo-clientes.destroy', $tipoCliente) }}"
                      class="d-inline"
                      onsubmit="return confirm('¿Está seguro de que desea eliminar este tipo de cliente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Tipo de Cliente Permanentemente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    code {
        background-color: #f3f4f6;
        border-radius: 4px;
        font-size: 0.9rem;
        padding: 0.25rem 0.5rem;
    }

    .border-danger {
        border: 2px solid #ef4444;
    }
</style>
@endsection
