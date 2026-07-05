<?php

namespace Tests\Feature;

use App\Models\TipoCliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TipoClienteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        URL::forceRootUrl('http://localhost');
    }

    public function test_muestra_el_index_y_el_formulario_de_creacion(): void
    {
        $this->get('/tipo-clientes')
            ->assertOk()
            ->assertSee('Lista de Tipos de Clientes');

        $this->get('/tipo-clientes/create')
            ->assertOk()
            ->assertSee('Formulario de Tipo de Cliente');
    }

    public function test_puede_crear_un_tipo_de_cliente(): void
    {
        $this->post('/tipo-clientes', [
            'nombre' => 'Delivery',
            'descuento' => 10,
            'estado' => 1,
        ])->assertRedirect(route('tipo-clientes.index', [], false));

        $this->assertDatabaseHas('tipo_clientes', [
            'nombre' => 'Delivery',
            'descuento' => 10,
            'estado' => 1,
        ]);
    }

    public function test_no_permite_repetir_el_nombre_ni_superar_el_descuento_maximo(): void
    {
        TipoCliente::create([
            'nombre' => 'Empresa',
            'descuento' => 20,
            'estado' => 1,
        ]);

        $this->post('/tipo-clientes', [
            'nombre' => 'Empresa',
            'descuento' => 101,
            'estado' => 1,
        ])->assertSessionHasErrors(['nombre', 'descuento']);

        $this->assertDatabaseCount('tipo_clientes', 1);
    }

    public function test_muestra_y_actualiza_un_tipo_de_cliente(): void
    {
        $tipoCliente = TipoCliente::create([
            'nombre' => 'Particular',
            'descuento' => 0,
            'estado' => 1,
        ]);

        $this->get('/tipo-clientes/'.$tipoCliente->id)
            ->assertOk()
            ->assertSee('Particular');

        $this->put('/tipo-clientes/'.$tipoCliente->id, [
            'nombre' => 'Particular frecuente',
            'descuento' => 5,
            'estado' => 0,
        ])->assertRedirect(route('tipo-clientes.index', [], false));

        $this->assertDatabaseHas('tipo_clientes', [
            'id' => $tipoCliente->id,
            'nombre' => 'Particular frecuente',
            'descuento' => 5,
            'estado' => 0,
        ]);
    }

    public function test_puede_eliminar_un_tipo_de_cliente(): void
    {
        $tipoCliente = TipoCliente::create([
            'nombre' => 'Temporal',
            'descuento' => 0,
            'estado' => 1,
        ]);

        $this->delete('/tipo-clientes/'.$tipoCliente->id)
            ->assertRedirect(route('tipo-clientes.index', [], false));

        $this->assertDatabaseMissing('tipo_clientes', ['id' => $tipoCliente->id]);
    }
}
