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
        //
        Schema::table('marcas_modelos', function (Blueprint $table) {
            $table->dropUnique('marcas_modelos_marca_id_modelo_id_unique');
            $table->unique('modelo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('marcas_modelos', function (Blueprint $table) {
            $table->dropUnique('marcas_modelos_modelo_id_unique');
            $table->unique(['marca_id', 'modelo_id']);
        });
    }
};
