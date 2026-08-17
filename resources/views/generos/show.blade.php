@extends('layouts.app')

@section('title', 'Ver Genero: ' . $genero->nombre)

@section('app_content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-person-badge"></i> {{ $genero->nombre }}</h1>
            <p>Detalles completos del género</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('generos.edit', $genero) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('generos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
       

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Información</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">ID</small>
                    <code class="text-dark">{{ $genero->id }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creado</small>
                    <strong>{{ $genero->created_at->format('d/m/Y') }}</strong><br>
                    <small class="text-muted">{{ $genero->created_at->format('H:i:s') }}</small>
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $genero->updated_at->format('d/m/Y') }}</strong><br>
                    <small class="text-muted">{{ $genero->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">

        <div class="card border-danger">
            <div class="card-header border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Zona de Peligro</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> Una vez eliminado, este género no podrá ser recuperado.
                </p>
                <form method="POST"
                      action="{{ route('generos.destroy', $genero) }}"
                      class="d-inline"
                      onsubmit="return confirm('¿Está seguro de que desea eliminar este género?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Género Permanentemente
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
