@extends('layouts.app')

@section('title', 'Crear Módulo')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-plus"></i> Formulario de Módulo</h5>
            </div>

            <form method="POST" action="{{ route('modulos.store') }}" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="form-label">
                                    <i class="bi bi-person-badge"></i> Nombre del Módulo
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                    id="nombre" name="nombre" value="{{ old('nombre') }}"
                                    placeholder="Ejemplo: Gestión Clientes, Gestión de productos..."
                                    maxlength="255" required>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug" class="form-label">
                                    <i class="bi bi-person-badge"></i> Slug del Módulo
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                    id="slug" name="slug" value="{{ old('slug') }}"
                                    placeholder="Ejemplo: gestion-clientes, gestion-productos..."
                                    maxlength="255" required>
                                @error('slug')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                   </div>

                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_modulo" class="form-label">
                                    <i class="bi bi-person-badge"></i> Tipo de Módulo
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control form-control-lg @error('tipo_modulo') is-invalid @enderror"
                                        id="tipo_modulo" name="tipo_modulo" required>
                                    <option value="">Seleccione un tipo</option>
                                    @foreach ($tiposModulo as $id => $tipo)
                                        <option value="{{ $id }}" {{ old('tipo_modulo') == $id ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_modulo')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label for="rela_padre" class="form-label">
                                    <i class="bi bi-person-badge"></i> Módulo Padre
                                </label>
                                <select class="form-control form-control-lg @error('rela_padre') is-invalid @enderror"
                                        id="rela_padre" name="rela_padre">
                                    <option value="">Seleccione el módulo padre</option>
                                    @foreach ($modulosPadres as $moduloPadre)
                                        <option value="{{ $moduloPadre->id }}" {{ old('rela_padre') == $moduloPadre->id ? 'selected' : '' }}>
                                            {{ $moduloPadre->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rela_padre')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ruta" class="form-label">
                                    <i class="bi bi-person-badge"></i> Ruta del Módulo
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('ruta') is-invalid @enderror"
                                    id="ruta" name="ruta" value="{{ old('ruta') }}"
                                    placeholder="Ejemplo: productos.index, clientes.index..."
                                    maxlength="255">
                                    @error('ruta')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               
                               <label for="icono" class="form-label">
                                    <i class="bi bi-person-badge"></i> Icono
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control form-control-lg @error('icono') is-invalid @enderror"
                                        id="icono" name="icono" required>
                                    <option value="">Seleccione un icono</option>
                                    @foreach ($iconos as $icono)
                                        <option value="{{ $icono }}" {{ old('icono') == $icono ? 'selected' : '' }}>
                                            {{ $icono }}
                                        </option>
                                    @endforeach 
                                </select>
                                @error('icono')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="orden" class="form-label">
                                    <i class="bi bi-person-badge"></i> Orden
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('orden') is-invalid @enderror"
                                    id="orden" name="orden" value="{{ old('orden') }}"
                                    placeholder="Ejemplo: 1, 2, 3..."
                                    maxlength="255" required>
                                
                                @error('orden')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="orden" class="form-label">
                                    <i class="bi bi-person-badge"></i> Estado
                                    <span class="text-danger">*</span>
                                </label><select class="form-control @error('estado') is-invalid @enderror"
                                        id="estado"
                                        name="estado"
                                        required>
                                    <option value="1" {{ old('estado', '1') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="es_visible" class="form-label">
                                    <i class="bi bi-person-badge"></i> Visible
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('es_visible') is-invalid @enderror"
                                        id="es_visible" name="es_visible" required>
                                    <option value="1" {{ old('es_visible', '1') === '1' ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ old('es_visible') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('es_visible')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> 
                        
                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('modulos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Crear Modulo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

