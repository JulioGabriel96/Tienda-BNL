@extends('layouts.app')

@section('title', 'Nueva subcategoria')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle"></i> Nueva subcategoria de {{ $categoria->nombre }}
                </h5>
            </div>

            <form method="POST" action="{{ route('subcategorias.store', $categoria) }}" novalidate>
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('nombre') is-invalid @enderror"
                               id="nombre"
                               name="nombre"
                               value="{{ old('nombre') }}"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                  id="descripcion"
                                  name="descripcion"
                                  rows="4">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="estado">Estado</label>
                        <select class="form-control @error('estado') is-invalid @enderror"
                                id="estado"
                                name="estado">
                            <option value="1" {{ old('estado', '1') === '1' ? 'selected' : '' }}>Activa</option>
                            <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactiva</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('subcategorias.index', $categoria) }}" class="btn btn-secondary mr-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                         Crear Subcategoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
