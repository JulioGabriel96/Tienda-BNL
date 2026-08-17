@extends('layouts.app')

@section('title', 'Editar Género: ' . $genero->nombre)

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-edit"></i> Formulario de Edición</h5>
            </div>

            <form method="POST" action="{{ route('generos.update', $genero) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="mb-4">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person-badge"></i> Género
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                               id="nombre"
                               name="nombre"
                               value="{{ old('nombre', $genero->nombre) }}"
                               maxlength="255"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="alert alert-info" role="alert">
                        <small>
                            <i class="bi bi-clock-history"></i> Creado el {{ $genero->created_at->format('d/m/Y H:i') }}<br>
                            <i class="bi bi-arrow-repeat"></i> Última actualización {{ $genero->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('generos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg"></i> Actualizar Género
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #00d4ff;
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
    }

    .form-label {
        color: #1f2937;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .alert-info {
        background-color: #ecf0ff;
        border: 1px solid #c7d2fe;
        border-radius: 8px;
        color: #1e40af;
    }
</style>
@endsection
