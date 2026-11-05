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
        Schema::create('table_modulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');
            $table->string('icono');
            $table->string('ruta')->unique();
            $table->boolean('estado')->default(true);
            $table->boolean('visible')->default(true);
            $table->smallInteger('tipo_modulo')->default(1);
            $table->unsignedBigInteger('orden')->nullable();
            $table->unsignedBigInteger('rela_padre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_modulos');
    }
};
