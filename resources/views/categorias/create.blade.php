@extends('layouts.app')

@section('title', 'Crear Nueva Categoría')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-plus"></i> Formulario de Categoría</h5>
            </div>

            <form method="POST" action="{{ route('categorias.store') }}" novalidate>
                @csrf

                <div class="card-body">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-tag"></i> Nombre de la Categoría
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}"
                               placeholder="Ejemplo: Kenda, Riffel, Michelin..."
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
                                  placeholder="Describe brevemente la categoría, sus características, historia, etc..."
                                  style="resize: vertical;">{{ old('descripcion') }}</textarea>
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Máximo 255 caracteres (opcional)
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
                            <option value="1" {{ old('estado', 1) == 1 ? 'selected' : '' }}>
                                <i class="bi bi-check-circle"></i> Activa
                            </option>
                            <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>
                                <i class="bi bi-x-circle"></i> Inactiva
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Crear Categoría
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
</style>
@endsection
