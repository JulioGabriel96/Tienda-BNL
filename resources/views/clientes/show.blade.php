@extends('layouts.app')

@section('title', 'Ver Cliente: ' . $cliente->nombre)

@section('app_content')
<div class="page-header">
    
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <p>Detalles completos del cliente</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> Datos del Cliente</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Nombre completo</dt>
                    <dd class="col-sm-8">{{ $cliente->nombre }} {{ $cliente->apellido }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $cliente->email }}</dd>

                    <dt class="col-sm-4">Telefono</dt>
                    <dd class="col-sm-8">{{ $cliente->telefono }}</dd>

                    <dt class="col-sm-4">Direccion</dt>
                    <dd class="col-sm-8">{{ $cliente->direccion ?: 'Sin direccion' }}</dd>

                    <dt class="col-sm-4">Fecha de nacimiento</dt>
                    <dd class="col-sm-8">{{ $cliente->fecha_nacimiento?->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Genero</dt>
                    <dd class="col-sm-8">{{ $cliente->genero?->nombre ?? 'Sin genero' }}</dd>

                    <dt class="col-sm-4">Tipo de cliente</dt>
                    <dd class="col-sm-8">{{ $cliente->tipoCliente?->nombre ?? 'Sin tipo de cliente' }}</dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8">
                        <span class="badge {{ $cliente->estado ? 'badge-success' : 'badge-secondary' }}">
                            {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card border-danger">
            <div class="card-header border-danger">
                <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Zona de Peligro</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i> Una vez eliminado, este cliente no podrá ser recuperado.
                </p>
                <form method="POST"
                      action="{{ route('clientes.destroy', $cliente) }}"
                      class="d-inline"
                      onsubmit="return confirm('¿Está seguro de que desea eliminar este cliente? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Cliente Permanentemente
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
