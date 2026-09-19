@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Formulario de Cliente</h5>
            </div>

            <form method="POST" action="{{ route('clientes.store') }}" novalidate>
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre"
                                        name="nombre"
                                        value="{{ old('nombre') }}"
                                        maxlength="255"
                                        placeholder="Nombre del cliente"
                                        required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido">Apellido <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('apellido') is-invalid @enderror"
                                        id="apellido"
                                        name="apellido"
                                        value="{{ old('apellido') }}"
                                        maxlength="255"
                                        placeholder="Apellido del cliente"
                                        required>
                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero_id">Género <span class="text-danger">*</span></label>
                                <select class="form-control @error('genero_id') is-invalid @enderror"
                                        id="genero_id"
                                        name="genero_id"
                                        required>
                                    <option value="">Seleccione un género</option>
                                    @foreach ($generos as $genero)
                                        <option value="{{ $genero->id }}"
                                                {{ (string) old('genero_id') === (string) $genero->id ? 'selected' : '' }}>
                                            {{ $genero->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genero_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                     <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Télefono <span class="text-danger">*</span></label>
                                <input type="tel"
                                       class="form-control @error('telefono') is-invalid @enderror"
                                       id="telefono"
                                       name="telefono"
                                       value="{{ old('telefono') }}"
                                       placeholder="Télefono del cliente" required>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       id="direccion"
                                       name="direccion"
                                       value="{{ old('direccion') }}"
                                       placeholder="Dirección del cliente">
                                       
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha Nacimiento <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                        id="fecha_nacimiento"
                                        name="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento') }}"
                                        placeholder="Fecha de nacimiento" required>
                                @error('fecha_nacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_cliente_id">Tipo Cliente <span class="text-danger">*</span></label>
                                <select class="form-control @error('tipo_cliente_id') is-invalid @enderror"
                                        id="tipo_cliente_id"
                                        name="tipo_cliente_id"
                                        required>
                                    <option value="">Seleccione un tipo de cliente</option>
                                    @foreach ($tipoCliente as $tipo_cliente)
                                        <option value="{{ $tipo_cliente->id }}"
                                                {{ (string) old('tipo_cliente_id') === (string) $tipo_cliente->id ? 'selected' : '' }}>
                                            {{ $tipo_cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select class="form-control @error('estado') is-invalid @enderror"
                                        id="estado"
                                        name="estado"
                                        required>
                                    <option value="" {{ old('estado') === '' ? 'selected' : '' }}>Seleccione un estado</option>
                                    <option value="1" {{ old('estado') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Crear Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
