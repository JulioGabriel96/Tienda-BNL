@extends('layouts.app')

@section('title', 'Editar Tipo de Cliente: ' . $tipoCliente->nombre)

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-edit"></i> Formulario de Edición</h5>
            </div>

            <form method="POST" action="{{ route('tipo-clientes.update', $tipoCliente) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="mb-4">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person-badge"></i> Nombre del Tipo de Cliente
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                               id="nombre"
                               name="nombre"
                               value="{{ old('nombre', $tipoCliente->nombre) }}"
                               maxlength="255"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descuento" class="form-label">
                            <i class="bi bi-percent"></i> Descuento
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <input type="number"
                                   class="form-control @error('descuento') is-invalid @enderror"
                                   id="descuento"
                                   name="descuento"
                                   value="{{ old('descuento', $tipoCliente->descuento) }}"
                                   min="0"
                                   max="100"
                                   step="1"
                                   required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        @error('descuento')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado <span class="text-danger">*</span></label>
                        <select class="form-control @error('estado') is-invalid @enderror"
                                id="estado"
                                name="estado"
                                required>
                            <option value="1" {{ old('estado', $tipoCliente->estado) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $tipoCliente->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info" role="alert">
                        <small>
                            <i class="bi bi-clock-history"></i> Creado el {{ $tipoCliente->created_at->format('d/m/Y H:i') }}<br>
                            <i class="bi bi-arrow-repeat"></i> Última actualización {{ $tipoCliente->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('tipo-clientes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg"></i> Actualizar Tipo de Cliente
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
