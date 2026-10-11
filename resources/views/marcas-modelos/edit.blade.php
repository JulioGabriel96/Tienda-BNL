@extends('layouts.app')

@section('title', 'Editar Modelo asociado: ' . $modeloMarcaVehiculo->modelo_vehiculo->nombre)

@section('app_content')


<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-edit"></i> Formulario de Edición</h5>
            </div>

            <form method="POST" action="{{ route('marcas-modelos.update', $modeloMarcaVehiculo->id) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="marca_id">Modelo <span class="text-danger">*</span></label>
                        <select class="form-control @error('modelo_id') is-invalid @enderror"
                                id="modelo_id" name="modelo_id" required>
                            <option value="">Seleccione un modelo</option>
                            @foreach ($modelosVehiculo as $modeloVehiculo)
                                <option value="{{ $modeloVehiculo->id }}"
                                        {{ (string) old('modelo_id', $modeloMarcaVehiculo->modelo_id) === (string) $modeloVehiculo->id ? 'selected' : '' }}>
                                    {{ $modeloVehiculo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('modelo_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label for="estado">Estado <span class="text-danger">*</span></label>
                        <select class="form-control @error('estado') is-invalid @enderror" 
                                id="estado" 
                                name="estado"
                                required>
                            <option value="1" {{ old('estado', $modeloMarcaVehiculo->estado) == 1 ? 'selected' : '' }}>
                                Activo
                            </option>
                            <option value="0" {{ old('estado', $modeloMarcaVehiculo->estado) == 0 ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <!-- Info de fechas -->
                    <div class="alert alert-info" role="alert">
                        <small>
                            <i class="bi bi-clock-history"></i> Creada el {{ $modeloMarcaVehiculo->created_at->format('d/m/Y H:i') }}<br>
                            <i class="bi bi-arrow-repeat"></i> Última actualización {{ $modeloMarcaVehiculo->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('marcas-modelos.index', $modeloMarcaVehiculo->marca_id) }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg"></i> Actualizar Modelo asociado.
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
