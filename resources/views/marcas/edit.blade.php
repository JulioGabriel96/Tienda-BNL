@extends('layouts.app')

@section('title', 'Editar Marca: ' . $marca->nombre)

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil-square"></i> Editar Marca</h1>
    <p>Actualiza la información de <strong>{{ $marca->nombre }}</strong></p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-edit"></i> Formulario de Edición</h5>
            </div>

            <form method="POST" action="{{ route('marcas.update', $marca->id) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-tag"></i> Nombre de la Marca
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $marca->nombre) }}"
                               placeholder="Ejemplo: Samsung, LG, Sony..."
                               required>
                        @error('nombre')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="form-label">
                            <i class="bi bi-file-text"></i> Descripción
                        </label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="5"
                                  placeholder="Describe brevemente la marca, sus características, historia, etc..."
                                  style="resize: vertical;">{{ old('descripcion', $marca->descripcion) }}</textarea>
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Máximo 500 caracteres (opcional)
                        </small>
                        @error('descripcion')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="mb-4">
                        <label for="estado" class="form-label">
                            <i class="bi bi-circle-fill"></i> Estado
                        </label>
                        <select class="form-select form-select-lg @error('estado') is-invalid @enderror" 
                                id="estado" 
                                name="estado">
                            <option value="1" {{ old('estado', $marca->estado) == 1 ? 'selected' : '' }}>
                                <i class="bi bi-check-circle"></i> Activa
                            </option>
                            <option value="0" {{ old('estado', $marca->estado) == 0 ? 'selected' : '' }}>
                                <i class="bi bi-x-circle"></i> Inactiva
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Info de fechas -->
                    <div class="alert alert-info" role="alert">
                        <small>
                            <i class="bi bi-clock-history"></i> Creada el {{ $marca->created_at->format('d/m/Y H:i') }}<br>
                            <i class="bi bi-arrow-repeat"></i> Última actualización {{ $marca->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('marcas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg"></i> Actualizar Marca
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control, .form-select {
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #00d4ff;
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
    }

    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .alert-info {
        background-color: #ecf0ff;
        border: 1px solid #c7d2fe;
        border-radius: 8px;
        color: #1e40af;
    }
</style>
@endsection
