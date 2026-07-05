@extends('layouts.app')

@section('title', 'Gestionar Productos')

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nuevo Producto
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('productos.index') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-md-0">
                                <label for="buscar">Producto</label>
                                <input type="text"
                                       class="form-control"
                                       id="buscar"
                                       name="buscar"
                                       value="{{ request('buscar') }}"
                                       placeholder="Código, barras, nombre o descripción">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="marca_id">Marca</label>
                                <select class="form-control" id="marca_id" name="marca_id">
                                    <option value="">Todas</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}"
                                                {{ (string) request('marca_id') === (string) $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="categoria_id">Categoría</label>
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                    <option value="">Todas</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                                {{ (string) request('categoria_id') === (string) $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-md-0">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="filter-actions w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-eraser"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Lista de Productos</h5>
                <div class="card-tools">Total de registros: {{ $productos->total() }}</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Marca / Categoría</th>
                            <th class="text-right">Precio venta</th>
                            <th class="text-center">Stock</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                            <tr>
                                <td>
                                    <strong>{{ $producto->codigo }}</strong>
                                    @if ($producto->codigo_barra)
                                        <small class="text-muted d-block">{{ $producto->codigo_barra }}</small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $producto->nombre }}</strong>
                                    <small class="text-muted d-block">
                                        {{ \Illuminate\Support\Str::limit($producto->descripcion ?: 'Sin descripción', 45) }}
                                    </small>
                                </td>
                                <td>
                                    {{ $producto->marca?->nombre ?? 'Sin marca' }}
                                    <small class="text-muted d-block">
                                        {{ $producto->subcategoria?->categoria?->nombre ?? 'Sin categoría' }} /
                                        {{ $producto->subcategoria?->nombre ?? 'Sin subcategoría' }}
                                    </small>
                                </td>
                                <td class="text-right">${{ number_format((float) $producto->precio_venta, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $producto->stock_actual <= $producto->stock_minimo ? 'badge-warning' : 'badge-success' }}">
                                        {{ $producto->stock_actual }}
                                    </span>
                                    <small class="text-muted d-block">Stock mín. {{ $producto->stock_minimo }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $producto->estado ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('productos.show', $producto) }}"
                                       class="btn btn-outline-info btn-sm"
                                       title="Ver ventas">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto) }}"
                                       class="btn btn-outline-warning btn-sm"
                                       title="Editar producto">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('productos.destroy', $producto) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de que desea eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar producto">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No se encontraron productos con los filtros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($productos->hasPages())
                <div class="card-footer d-flex flex-wrap align-items-center justify-content-between">
                    <span class="text-muted small">
                        Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }} registros
                    </span>
                    <div>{{ $productos->links() }}</div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .filter-actions {
        display: flex;
        gap: 0.5rem;
    }

    .filter-actions .btn {
        flex: 1 1 0;
    }
</style>
@endsection
