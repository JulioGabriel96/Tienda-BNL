<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\SubCategoria;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        URL::forceRootUrl('http://localhost');
    }

    public function test_se_puede_crear_un_producto_con_stock_inicial(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();

        $response = $this->post('/productos', $this->datosProducto(
            $marca,
            $categoria,
            $subcategoria
        ));

        $response->assertRedirect(route('productos.index', [], false));
        $this->assertDatabaseHas('productos', [
            'codigo' => 'PROD-001',
            'stock_actual' => 10,
            'marca_id' => $marca->id,
            'subcategoria_id' => $subcategoria->id,
        ]);
    }

    public function test_create_y_edit_utilizan_formularios_independientes(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $producto = Producto::create(
            collect($this->datosProducto($marca, $categoria, $subcategoria))
                ->except('categoria_id')
                ->all()
        );

        $this->get('/productos/create')
            ->assertOk()
            ->assertSee('Formulario de Producto')
            ->assertSee('name="stock_actual"', false);

        $this->get('/productos/'.$producto->id.'/edit')
            ->assertOk()
            ->assertSee('Formulario de Edición')
            ->assertDontSee('name="stock_actual"', false);
    }

    public function test_no_se_puede_repetir_el_mismo_producto(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $datos = $this->datosProducto($marca, $categoria, $subcategoria);

        $this->post('/productos', $datos)->assertSessionHasNoErrors();

        $datos['codigo'] = 'PROD-002';

        $this->post('/productos', $datos)
            ->assertSessionHasErrors('codigo_barra');

        $this->assertDatabaseCount('productos', 1);
    }

    public function test_el_stock_actual_no_se_modifica_en_la_edicion(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $producto = Producto::create(
            collect($this->datosProducto($marca, $categoria, $subcategoria))
                ->except('categoria_id')
                ->all()
        );

        $datos = $this->datosProducto($marca, $categoria, $subcategoria);
        $datos['nombre'] = 'Producto editado';
        unset($datos['stock_actual']);

        $this->put('/productos/'.$producto->id, $datos)
            ->assertRedirect(route('productos.index', [], false));

        $producto->refresh();
        $this->assertSame('Producto editado', $producto->nombre);
        $this->assertSame(10, $producto->stock_actual);

        $datos['stock_actual'] = 999;

        $this->put('/productos/'.$producto->id, $datos)
            ->assertSessionHasErrors('stock_actual');

        $this->assertSame(10, $producto->fresh()->stock_actual);
    }

    public function test_show_informa_solo_las_ventas_del_producto(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $producto = Producto::create(
            collect($this->datosProducto($marca, $categoria, $subcategoria))
                ->except('categoria_id')
                ->all()
        );

        $this->get('/productos/'.$producto->id)
            ->assertOk()
            ->assertSee('Ventas de '.$producto->nombre)
            ->assertSee('Total de ventas de hoy')
            ->assertSee('Total histórico de ventas')
            ->assertSee('$0,00')
            ->assertSee('0 unidades vendidas')
            ->assertSee('No se registraron ventas para este producto.');
    }

    public function test_se_puede_eliminar_un_producto_sin_ventas(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $producto = Producto::create(
            collect($this->datosProducto($marca, $categoria, $subcategoria))
                ->except('categoria_id')
                ->all()
        );

        $this->delete('/productos/'.$producto->id)
            ->assertRedirect(route('productos.index', [], false))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }

    public function test_no_se_puede_eliminar_un_producto_con_ventas(): void
    {
        [$marca, $categoria, $subcategoria] = $this->crearClasificacion();
        $producto = Producto::create(
            collect($this->datosProducto($marca, $categoria, $subcategoria))
                ->except('categoria_id')
                ->all()
        );
        $this->crearTablasVentas();

        $ventaId = DB::table('ventas')->insertGetId([
            'fecha' => '2026-06-29',
            'hora' => '10:30:00',
            'nro_comprobante' => 1001,
            'subtotal' => 150,
            'total' => 150,
        ]);
        DB::table('ventas_detalle')->insert([
            'venta_id' => $ventaId,
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'precio_unitario' => 150,
        ]);

        $this->delete('/productos/'.$producto->id)
            ->assertRedirect(route('productos.index', [], false))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('productos', ['id' => $producto->id]);
    }

    private function crearClasificacion(): array
    {
        $marca = Marca::create([
            'nombre' => 'Marca de prueba',
            'descripcion' => null,
            'estado' => true,
        ]);
        $categoria = Categoria::create([
            'nombre' => 'Categoría de prueba',
            'descripcion' => null,
            'estado' => true,
        ]);
        $subcategoria = SubCategoria::create([
            'nombre' => 'Subcategoría de prueba',
            'descripcion' => null,
            'estado' => true,
            'categoria_id' => $categoria->id,
        ]);

        return [$marca, $categoria, $subcategoria];
    }

    private function crearTablasVentas(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('nro_comprobante');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);
        });
        Schema::create('ventas_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id');
            $table->foreignId('producto_id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
        });
    }

    private function datosProducto(
        Marca $marca,
        Categoria $categoria,
        SubCategoria $subcategoria
    ): array {
        return [
            'codigo' => 'PROD-001',
            'codigo_barra' => '779000000001',
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción de prueba',
            'precio_costo' => 100,
            'porcentaje_ganancia' => 50,
            'precio_venta' => 150,
            'stock_minimo' => 2,
            'stock_actual' => 10,
            'estado' => 1,
            'marca_id' => $marca->id,
            'categoria_id' => $categoria->id,
            'subcategoria_id' => $subcategoria->id,
        ];
    }
}
