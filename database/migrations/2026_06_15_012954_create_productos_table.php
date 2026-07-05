<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('codigo_barra')->nullable()->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_costo', 12, 2);
            $table->decimal('porcentaje_ganancia', 5, 2)->default(0);
            $table->decimal('precio_venta', 12, 2);
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_actual')->default(0);
            $table->boolean('estado')->default(true);
            $table->foreignId('subcategoria_id')->constrained('sub_categorias')->restrictOnDelete();
            $table->foreignId('marca_id')->constrained('marcas')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
