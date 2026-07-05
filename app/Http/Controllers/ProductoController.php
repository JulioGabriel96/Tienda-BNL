<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Services\Producto\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $filtros = $request->only(['buscar', 'marca_id', 'categoria_id', 'estado']);
        $productos = Producto::query()
            ->with(['marca', 'subcategoria.categoria'])
            ->buscar($filtros)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $marcas = Marca::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.index', compact('productos', 'marcas', 'categorias'));
    }

    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        $categorias = Categoria::with([
            'subcategorias' => fn ($query) => $query->orderBy('nombre'),
        ])->orderBy('nombre')->get();

        return view('productos.create', compact('marcas', 'categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $datos = $request->safe()->except('categoria_id');
        Producto::create($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        $totalVentasHoy = 0;
        $totalVentasHistorico = 0;
        $cantidadVendidaHoy = 0;
        $cantidadVendidaHistorica = 0;

        $ventas = new LengthAwarePaginator(
            [],
            0,
            10,
            LengthAwarePaginator::resolveCurrentPage(),
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('productos.show', compact(
            'producto',
            'ventas',
            'totalVentasHoy',
            'totalVentasHistorico',
            'cantidadVendidaHoy',
            'cantidadVendidaHistorica'
        ));
    }

    public function edit(Producto $producto)
    {
        $producto->load('subcategoria');
        $marcas = Marca::orderBy('nombre')->get();
        $categorias = Categoria::with([
            'subcategorias' => fn ($query) => $query->orderBy('nombre'),
        ])->orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'marcas', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $datos = $request->safe()->except(['categoria_id', 'stock_actual']);
        $producto->update($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto, ProductoService $productoService)
    {
        $permitirEliminar = $productoService->eliminarProducto($producto);

        if (! $permitirEliminar) {
            $mensaje = 'No se puede eliminar el producto porque tiene ventas asociadas.';
            $tipo = 'error';
        } else {
            $mensaje = 'Producto eliminado exitosamente.';
            $tipo = 'success';
        }

        return redirect()
            ->route('productos.index')
            ->with($tipo, $mensaje);
    }
}
