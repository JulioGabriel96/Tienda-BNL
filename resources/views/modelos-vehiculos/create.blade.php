@extends('layouts.app')

@section('title', 'Crear Nuevo Modelo de Vehículo')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-plus"></i> Formulario de Modelos de Vehículos</h5>
            </div>

            <form method="POST" action="{{ route('modelos-vehiculos.store') }}" novalidate>
                @csrf

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
                               value="{{ old('nombre') }}"
                               placeholder="Ejemplo: Wave, XTR, Blitz..."
                               required>
                        @error('nombre')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer bg-light d-flex gap-2 justify-content-end">
                    <a href="{{ route('modelos-vehiculos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Crear Modelo de Vehículo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
