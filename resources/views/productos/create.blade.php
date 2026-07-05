@extends('layouts.app')

@section('title', 'Crear Producto')

@section('app_content')
<div class="row justify-content-center pt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Formulario de Producto</h5>
            </div>

            <form method="POST" action="{{ route('productos.store') }}" novalidate>
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Código interno <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('codigo') is-invalid @enderror"
                                       id="codigo"
                                       name="codigo"
                                       value="{{ old('codigo') }}"
                                       maxlength="255"
                                       required>
                                @error('codigo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo_barra">Código de barras</label>
                                <input type="text"
                                       class="form-control @error('codigo_barra') is-invalid @enderror"
                                       id="codigo_barra"
                                       name="codigo_barra"
                                       value="{{ old('codigo_barra') }}"
                                       maxlength="255">
                                @error('codigo_barra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('nombre') is-invalid @enderror"
                                       id="nombre"
                                       name="nombre"
                                       value="{{ old('nombre') }}"
                                       maxlength="255"
                                       required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                  id="descripcion"
                                  name="descripcion"
                                  rows="3">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="marca_id">Marca <span class="text-danger">*</span></label>
                                <select class="form-control @error('marca_id') is-invalid @enderror"
                                        id="marca_id"
                                        name="marca_id"
                                        required>
                                    <option value="">Seleccione una marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}"
                                                {{ (string) old('marca_id') === (string) $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('marca_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categoria_id">Categoría <span class="text-danger">*</span></label>
                                <select class="form-control @error('categoria_id') is-invalid @enderror"
                                        id="categoria_id"
                                        name="categoria_id"
                                        required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                                {{ (string) old('categoria_id') === (string) $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subcategoria_id">Subcategoría <span class="text-danger">*</span></label>
                                <select class="form-control @error('subcategoria_id') is-invalid @enderror"
                                        id="subcategoria_id"
                                        name="subcategoria_id"
                                        required>
                                    <option value="">Seleccione una subcategoría</option>
                                    @foreach ($categorias as $categoria)
                                        @foreach ($categoria->subcategorias as $subcategoria)
                                            <option value="{{ $subcategoria->id }}"
                                                    data-categoria="{{ $categoria->id }}"
                                                    {{ (string) old('subcategoria_id') === (string) $subcategoria->id ? 'selected' : '' }}>
                                                {{ $subcategoria->nombre }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('subcategoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="precio_costo">Precio de costo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="number"
                                           class="form-control @error('precio_costo') is-invalid @enderror"
                                           id="precio_costo"
                                           name="precio_costo"
                                           value="{{ old('precio_costo') }}"
                                           min="0"
                                           step="0.01"
                                           required>
                                    @error('precio_costo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="porcentaje_ganancia">Ganancia <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number"
                                           class="form-control @error('porcentaje_ganancia') is-invalid @enderror"
                                           id="porcentaje_ganancia"
                                           name="porcentaje_ganancia"
                                           value="{{ old('porcentaje_ganancia', 0) }}"
                                           min="0"
                                           max="999.99"
                                           step="0.01"
                                           required>
                                    <div class="input-group-append"><span class="input-group-text">%</span></div>
                                    @error('porcentaje_ganancia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="precio_venta">Precio de venta <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="number"
                                           class="form-control @error('precio_venta') is-invalid @enderror"
                                           id="precio_venta"
                                           name="precio_venta"
                                           value="{{ old('precio_venta') }}"
                                           min="0"
                                           step="0.01"
                                           required>
                                    @error('precio_venta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock_minimo">Stock mínimo <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('stock_minimo') is-invalid @enderror"
                                       id="stock_minimo"
                                       name="stock_minimo"
                                       value="{{ old('stock_minimo', 0) }}"
                                       min="0"
                                       step="1"
                                       required>
                                @error('stock_minimo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock_actual">Stock actual inicial <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control @error('stock_actual') is-invalid @enderror"
                                       id="stock_actual"
                                       name="stock_actual"
                                       value="{{ old('stock_actual', 0) }}"
                                       min="0"
                                       step="1"
                                       required>
                                @error('stock_actual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Este valor solo se carga al crear el producto.</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select class="form-control @error('estado') is-invalid @enderror"
                                        id="estado"
                                        name="estado"
                                        required>
                                    <option value="1" {{ old('estado', '1') === '1' ? 'selected' : '' }}>Activo</option>
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
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Crear Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoria = document.getElementById('categoria_id');
        const subcategoria = document.getElementById('subcategoria_id');

        function filtrarSubcategorias() {
            const categoriaId = categoria.value;

            Array.from(subcategoria.options).forEach(function (option) {
                if (!option.value) {
                    return;
                }

                const visible = option.dataset.categoria === categoriaId;
                option.hidden = !visible;
                option.disabled = !visible;
            });

            if (subcategoria.selectedOptions.length && subcategoria.selectedOptions[0].disabled) {
                subcategoria.value = '';
            }

            subcategoria.disabled = !categoriaId;
        }

        categoria.addEventListener('change', filtrarSubcategorias);
        filtrarSubcategorias();
    });
</script>
@endpush
