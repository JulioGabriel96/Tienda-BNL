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
        Schema::create('marcas_modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->references('id')->on('marcas_vehiculos');
            $table->foreignId('modelo_id')->references('id')->on('modelos_vehiculos');
            $table->unique(['marca_id', 'modelo_id']);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas_modelos');
    }
};
