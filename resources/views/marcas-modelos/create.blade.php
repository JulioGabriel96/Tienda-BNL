@extends('layouts.app')

@section('title', 'Nuevo Modelo de la marca')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle"></i> Nuevo Modelo de la marca {{ $marcaVehiculo->nombre }}
                </h5>
            </div>

            <form method="POST" action="{{ route('marcas-modelos.store', $marcaVehiculo) }}" novalidate>
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="modelo_id">Modelos <span class="text-danger">*</span></label>
                        <select class="form-control @error('modelo_id') is-invalid @enderror"
                                id="modelo_id"
                                name="modelo_id"
                                required>
                            <option value="">Seleccione un modelo.</option>
                            @foreach ($modeloVehiculo as $modelo)
                                <option value="{{ $modelo->id }}"
                                        {{ (string) old('modelo_id') === (string) $modelo->id ? 'selected' : '' }}>
                                    {{ $modelo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('modelo_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                   <a href="{{ route('marcas-modelos.index', $marcaVehiculo) }}" class="btn btn-secondary mr-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                         Crear Modelo Asociado a la Marca
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 