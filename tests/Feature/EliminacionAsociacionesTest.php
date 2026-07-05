<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\SubCategoria;
use App\Models\TipoCliente;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EliminacionAsociacionesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        URL::forceRootUrl('http://localhost');
    }

    public function test_no_elimina_una_marca_asociada_a_productos(): void
    {
        $marca = Marca::create([
            'nombre' => 'Marca asociada',
            'descripcion' => null,
            'estado' => 1,
        ]);
        $categoria = Categoria::create([
            'nombre' => 'Categoría',
            'descripcion' => null,
            'estado' => 1,
        ]);
        $subcategoria = SubCategoria::create([
            'nombre' => 'Subcategoría',
            'descripcion' => null,
            'estado' => 1,
            'categoria_id' => $categoria->id,
        ]);
        Producto::create([
            'codigo' => 'PROD-MARCA',
            'codigo_barra' => '779000009999',
            'nombre' => 'Producto asociado',
            'descripcion' => null,
            'precio_costo' => 100,
            'porcentaje_ganancia' => 20,
            'precio_venta' => 120,
            'stock_minimo' => 1,
            'stock_actual' => 5,
            'estado' => 1,
            'subcategoria_id' => $subcategoria->id,
            'marca_id' => $marca->id,
        ]);

        $this->delete('/marcas/'.$marca->id)
            ->assertRedirect(route('marcas.index', [], false))
            ->assertSessionHas(
                'error',
                'No se puede eliminar la marca porque está asociada a uno o más productos.'
            );

        $this->assertDatabaseHas('marcas', ['id' => $marca->id]);
    }

    public function test_elimina_una_marca_sin_productos(): void
    {
        $marca = Marca::create([
            'nombre' => 'Marca libre',
            'descripcion' => null,
            'estado' => 1,
        ]);

        $this->delete('/marcas/'.$marca->id)
            ->assertRedirect(route('marcas.index', [], false))
            ->assertSessionHas('success', 'Marca eliminada exitosamente.');

        $this->assertDatabaseMissing('marcas', ['id' => $marca->id]);
    }

    public function test_no_elimina_un_tipo_de_cliente_asociado_a_clientes(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_cliente_id');
            $table->timestamps();
        });

        $tipoCliente = TipoCliente::create([
            'nombre' => 'Tipo asociado',
            'descuento' => 10,
            'estado' => 1,
        ]);
        Cliente::create([
            'tipo_cliente_id' => $tipoCliente->id,
        ]);

        $this->delete('/tipo-clientes/'.$tipoCliente->id)
            ->assertRedirect(route('tipo-clientes.index', [], false))
            ->assertSessionHas(
                'error',
                'No se puede eliminar el tipo de cliente porque está asociado a uno o más clientes.'
            );

        $this->assertDatabaseHas('tipo_clientes', ['id' => $tipoCliente->id]);
    }
}
