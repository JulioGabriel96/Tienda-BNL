@extends('layouts.app')

@section('title', 'Gestionar Modulos')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('modulos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo Módulo
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('modulos.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-md-0">
                                <label for="nombre">Nombre del Módulo</label>
                                <input type="text" class="form-control"
                                id="nombre" name="nombre" value="{{ request('nombre') }}"
                                    placeholder="Buscar por nombre del módulo">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="tipo">Tipo de Módulo</label>
                                <select class="form-control" id="tipo_modulo" name="tipo_modulo">
                                    <option value="">Todos</option>
                                    @foreach ($tiposModulo as $id => $tipo)
                                        <option value="{{ $id }}" {{ request('tipo_modulo') == $id ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="es_visible">Visible</label>
                                <select class="form-control" id="es_visible" name="es_visible">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('es_visible') === '1' ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ request('es_visible') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('modulos.index') }}" class="btn btn-secondary">
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
                <h5 class="card-title mb-0"><i class="bi bi-table"></i> Lista de Módulos</h5>
                <div class="card-tools">
                    Total de registros: <span>{{ $modulos->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-light">
                            <th><i class="bi bi-person-badge"></i> Nombre</th>
                            <th><i class="bi bi-person-badge"></i> Slug</th>
                            <th><i class="bi bi-person-badge"></i> Tipo de Modulo</th>
                            <th><i class="bi bi-person-badge"></i> Icono</th>
                            <th><i class="bi bi-person-badge"></i> Ruta</th>
                            <th><i class="bi bi-person-badge"></i> Estado</th>
                            <th><i class="bi bi-person-badge"></i> Visible</th>
                            <th><i class="bi bi-person-badge"></i> Orden</th>
                            <th class="text-center"><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modulos as $modulo)
                            <tr>
                                <td>{{ $modulo->nombre }}</td>
                                <td>{{ $modulo->slug }}</td>
                                <td> 
                                    <span class="{{ $modulo->colorTipoModulo() }}">
                                        {{ $modulo->tipoModulo() }}
                                    </span> 

                                    <div>
                                        <small class="text-muted">
                                            {{ $modulo->parent?->nombre }}
                                        </small>
                                    </div>
                            
                                </td>
                                <td> <i class="{{ $modulo->icono }}"></i></td>
                                <td>{{ $modulo->ruta }}</td>
                                <td> <span class="{{ $modulo->colorEstado() }}">{{ $modulo->mostrarEstado() }}</span></td>
                                <td>  <span class="{{ $modulo->colorVisible() }}">{{ $modulo->mostrarVisible() }}</span></td>
                                <td>{{ $modulo->orden }}</td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('modulos.show', $modulo) }}"
                                           class="btn btn-outline-info btn-sm"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('modulos.edit', $modulo) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar registro">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('modulos.cambiarEstado', $modulo) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ $modulo->mostrarMensajeConfirmacion() }}');">
                                            @csrf
                                            <button type="submit" class='{{ $modulo->mostrarBotonActivarDesactivar() }}' 
                                            title="Desactivar/Activar registro">
                                                <i class='{{ $modulo->mostrarIcono() }}'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No se encontraron modulos con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($modulos->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $modulos->firstItem() }} a {{ $modulos->lastItem() }} de {{ $modulos->total() }} registros
                    </div>
                    <div class="pagination-wrapper ml-auto">
                        {{ $modulos->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
