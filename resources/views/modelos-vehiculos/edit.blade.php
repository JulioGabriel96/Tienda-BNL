@extends('layouts.app')
 
@section('title', 'Editar Modelo de Vehículo: ' . $modeloVehiculo->nombre)

@section('app_content')


<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-edit"></i> Formulario de Edición</h5>
            </div>

            <form method="POST" action="{{ route('modelos-vehiculos.update', $modeloVehiculo) }}" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-tag"></i> Nombre del Modelo del Vehículo
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $modeloVehiculo->nombre) }}"
                               placeholder="Ejemplo: Wave, XTR, Blitz..."
                               required>
                        @error('nombre')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror 
                    </div>

                    <!-- Info de fechas -->
                    <div class="alert alert-info" role="alert">
                        <small>
                            <i class="bi bi-clock-history"></i> Creado el {{ $modeloVehiculo->created_at->format('d/m/Y H:i') }}<br>
                            <i class="bi bi-arrow-repeat"></i> Última actualización {{ $modeloVehiculo->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('modelos-vehiculos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg"></i> Actualizar Modelo de Vehículo
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
