@extends('layouts.app')

@section('title', 'Modelos-Marcas ' . $marcaVehiculo->nombre)

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div>
                    <h5 class="mb-0">
                        <i class="fas fa-sitemap"></i> Modelos asociados de la marca {{ $marcaVehiculo->nombre }}
                    </h5>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('marcas-vehiculos.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('marcas-modelos.create', $marcaVehiculo) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo modelo asociado a la marca.
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('marcas-modelos.index', $marcaVehiculo) }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-md-0">
                                <label for="modelo_id">Modelo de Vehículo</label>
                                <select class="form-control" id="modelo_id" name="modelo_id">
                                    <option value="">Todos</option>
                                    @foreach ($modeloVehiculo as $modelo)
                                        <option value="{{ $modelo->id }}"
                                                {{ (string) request('modelo_id') === (string) $modelo->id ? 'selected' : '' }}>
                                            {{ $modelo->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            

                            </div>

                            
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('marcas-modelos.index', $marcaVehiculo) }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="fas fa-list"></i> Lista de modelos</h5>
                <div class="card-tools">
                    Total de registros: <span>{{ $modelosMarcaVehiculo->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modelosMarcaVehiculo as $modeloMarcaVehiculo)
                            <tr>
                                
                                <td><strong>{{ $modeloMarcaVehiculo->modelo_vehiculo->nombre }}</strong></td>

                                <td>
                                    <span class="badge {{ $modeloMarcaVehiculo->estado == 1 ? 'badge bg-success-light text-success' : 'badge bg-danger-light text-danger' }}">
                                        {{ $modeloMarcaVehiculo->estado == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>

                                <td class="text-left">
                                    <div class="action-buttons">
                                        <a href="{{ route('marcas-modelos.show', $modeloMarcaVehiculo->id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('marcas-modelos.edit', $modeloMarcaVehiculo->id) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>                                        
                                        <form method="POST"
                                              action="{{ route('marcas-modelos.destroy', $modeloMarcaVehiculo->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ $modeloMarcaVehiculo->mostrarMensajeConfirmacion() }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class='{{ $modeloMarcaVehiculo->mostrarTipoColores()}}'"
                                                    title="Desactivar/Activar registro">
                                                    <i class='{{$modeloMarcaVehiculo->mostrarTipoBotones()}}'></i>

                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No se encontraron modelos asociados para esta marca.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($modelosMarcaVehiculo->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $modelosMarcaVehiculo->firstItem() }} a {{ $modelosMarcaVehiculo->lastItem() }}
                        de {{ $modelosMarcaVehiculo->total() }} registros
                    </div>
                    <div class="pagination-wrapper ml-auto">
                        {{ $modelosMarcaVehiculo->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
