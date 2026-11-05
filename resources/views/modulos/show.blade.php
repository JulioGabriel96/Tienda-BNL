@extends('layouts.app')

@section('title', 'Ver Modulo: ' . $modulo->nombre) 

@section('app_content')


<div class="page-header mt-4">
    <div class="d-flex justify-content-between align-items-center ">
        <div>
            <h1><i class="fas fa-folder"></i>  {{ $modulo->nombre }} <span class="{{ $modulo->colorTipoModulo() }}">
                {{ $modulo->tipoModulo() }}
            </span></h1>
            <p>Detalles completos del módulo @if($modulo->tipo_modulo === 1) padre @endif </p>
        </div>
         <div class="d-flex gap-2">
            <a href="{{ route('modulos.edit', $modulo) }}" class="btn btn-warning">
                <i class="fas fa-pencil-alt"></i> Editar
            </a>
            <a href="{{ route('modulos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div  class="row align-items-stretch">
    <div class="col-lg-4 d-flex">
        <div class="card w-100 flex-grow-1 mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Información</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">ID</small>
                    <code class="text-dark">{{ $modulo->id }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Slug</small>
                    <code class="text-dark">{{ $modulo->slug }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Tipo de Módulo</small>
                    <span class="{{ $modulo->colorTipoModulo() }}">
                        {{ $modulo->tipoModulo() }}
                    </span>
                </div>
                @if($modulo->parent)
                    <div class="mb-3">
                        <small class="text-muted d-block">Padre</small>
                        <span class="">
                            {{ $modulo->parent?->nombre }}
                        </span>
                    </div>
                @endif
                <div class="mb-3">
                    <small class="text-muted d-block">Icono</small>
                    <i class="{{ $modulo->icono }}"></i> <code class="text-dark">{{ $modulo->icono }}</code>
                </div>
                @if($modulo->tipo_modulo === 2)
                <div class="mb-3">
                    <small class="text-muted d-block">Contenedor</small>
                    <span class="">
                        {{ $modulo->parent?->nombre }}
                    </span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Ruta</small>
                    <code class="text-dark">{{ $modulo->ruta }}</code>
                </div>
                @endif
                <div class="mb-3">
                    <small class="text-muted d-block">Estado</small>
                    <span class="{{ $modulo->colorEstado() }}">{{ $modulo->mostrarEstado() }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Visible</small>
                    <span class="{{ $modulo->colorVisible() }}">{{ $modulo->mostrarVisible() }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Creado</small>
                    <strong>{{ $modulo->created_at->format('d/m/Y') }}</strong> <small class="text-muted">{{ $modulo->created_at->format('H:i:s') }}</small>
                    
                </div>
                <div>
                    <small class="text-muted d-block">Última modificación</small>
                    <strong>{{ $modulo->updated_at->format('d/m/Y') }}</strong>
                    <small class="text-muted">{{ $modulo->updated_at->format('H:i:s') }}</small>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-lg-8 d-flex flex-column">
        @if($modulo->tipo_modulo === 1)
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-list"></i> Lista de Módulos</h5>
                <div class="card-tools">
                    Total de registros: <span>{{ $modulosAsociados->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-light">
                            <th><i class="bi bi-person-badge"></i> Nombre</th>
                            <th><i class="bi bi-person-badge"></i> Slug</th>
                            <th><i class="bi bi-person-badge"></i> Icono</th>
                            <th><i class="bi bi-person-badge"></i> Ruta</th>
                            <th><i class="bi bi-person-badge"></i> Estado</th>
                            <th><i class="bi bi-person-badge"></i> Visible</th>
                            <th><i class="bi bi-person-badge"></i> Orden</th>
                            <th><i class="bi bi-person-badge"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modulosAsociados as $moduloHijo)
                            <tr>
                                <td>{{ $moduloHijo->nombre }}</td>
                                <td>{{ $moduloHijo->slug }}</td>
                                <td> <i class="{{ $moduloHijo->icono }}"></i></td>
                                <td>{{ $moduloHijo->ruta }}</td>
                                <td> <span class="{{ $moduloHijo->colorEstado() }}">{{ $moduloHijo->mostrarEstado() }}</span></td>
                                <td>  <span class="{{ $moduloHijo->colorVisible() }}">{{ $moduloHijo->mostrarVisible() }}</span></td>
                                <td>{{ $moduloHijo->orden }}</td>
                                <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('modulos.show', $moduloHijo) }}"
                                            class="btn btn-outline-info btn-sm"
                                            title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                

                                            <a href="{{ route('modulos.edit', $moduloHijo) }}"
                                            class="btn btn-outline-warning btn-sm"
                                            title="Editar registro">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('modulos.cambiarEstado', $moduloHijo) }}"
                                                class="d-inline"
                                                onsubmit="return confirm('{{ $moduloHijo->mostrarMensajeConfirmacion() }}');">
                                                @csrf
                                                <button type="submit" class='{{ $moduloHijo->mostrarBotonActivarDesactivar() }}' 
                                                title="Desactivar/Activar registro">
                                                    <i class='{{ $moduloHijo->mostrarIcono() }}'></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No se encontraron modulos asociados a este contenedor {{ $modulo->nombre }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($modulosAsociados->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="text-muted small mb-2 mb-md-0">
                        Mostrando {{ $modulosAsociados->firstItem() }} a {{ $modulosAsociados->lastItem() }} de {{ $modulosAsociados->total() }} registros
                    </div>
                    <div class="pagination-wrapper ml-auto">
                        {{ $modulosAsociados->links() }}
                    </div>
                </div>
                @endif
                
                <div class="px-3 pb-3 mt-4">
                        <div class="alert alert-info w-100 py-2 px-3 mb-0" role="alert">
                        <small>
                            <i class="fas fa-info-circle mr-1"></i>
                            Estos módulos pertenecen al contenedor <strong>{{ $modulo->nombre }}</strong>.
                            Su activación o inactivación se administra individual
                        </small>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row flex-grow-1">
            <div class="col-md-12 d-flex">

                <div class="card w-100 d-flex flex-column">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs mr-1"></i>
                            Acciones sobre el contenedor
                        </h5>
                    </div>

                    <div class="card-body flex-grow-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-danger mb-0">
                                    <div class="card-header bg-white border-{{ $modulo->estado == 1 ? 'danger' : 'success' }}">
                                        <h6 class="mb-0 text-{{ $modulo->estado == 1 ? 'danger' : 'success' }}">
                                            <i class="{{ $modulo->mostrarIcono() }}"></i>
                                            @if($modulo->estado == 1) Inactivar @else Activar @endif Contenedor
                                        </h6>
                                    </div>

                                    <div class="card-body">
                                        <p class="text-muted small">
                                            Esta acción @if($modulo->estado == 1) Inactivará @else Activará @endif Contenedor
                                            el contenedor
                                            y todos sus módulos asociados.
                                        </p>

                                        <form method="POST" action="{{ route('modulos.cambiarEstado', $modulo->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ $modulo->mostrarMensajeConfirmacion() }}');">
                                            @csrf
                                            <button type="submit" class='{{ $modulo->mostrarBotonActivarDesactivar() }}' 
                                            title="Desactivar/Activar registro">
                                                <i class='{{ $modulo->mostrarIcono() }}'></i>
                                                @if($modulo->estado == 1) Inactivar @else Activar @endif Contenedor
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
        
    </div>
</div> 
@endsection
