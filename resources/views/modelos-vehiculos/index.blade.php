@extends('layouts.app')

@section('title', 'Gestionar Modelos de Vehículos')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('modelos-vehiculos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo Modelo de Vehículo
                    </a>
                </div>
            </div> 

            <form method="GET" action="{{ route('modelos-vehiculos.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-md-0">
                                <label for="nombre">Nombre del Modelo de Vehículo</label>
                                <input type="text"
                                       class="form-control"
                                       id="nombre"
                                       name="nombre"
                                       value="{{ request('nombre') }}"
                                       placeholder="Buscar por nombre">
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('modelos-vehiculos.index') }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="bi bi-table"></i> Lista de Modelos de Vehículos</h5>
                <div class="card-tools"> Total de registros:
                    <span>{{ $modelosVehiculo->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-light">
                            <th><i class="bi bi-tag"></i> Nombre</th>
                            <th class="text-center"><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modelosVehiculo as $modelo)
                            <tr>
                                <td>
                                    <strong>{{ $modelo->nombre }}</strong>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('modelos-vehiculos.show', $modelo->id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('modelos-vehiculos.edit', $modelo->id) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ route('modelos-vehiculos.destroy', $modelo->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Estas seguro de que deseas eliminar este modelo de vehículo?');">
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
                                <td colspan="2" class="text-center text-muted py-4">
                                    No se encontraron modelos con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody> 
                </table>
            </div>

            @if ($modelosVehiculo->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $modelosVehiculo->firstItem() }} a {{ $modelosVehiculo->lastItem() }} de {{ $modelosVehiculo->total() }} registros
                    </div>

                    <div class="pagination-wrapper ml-auto">
                        {{ $modelosVehiculo->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
