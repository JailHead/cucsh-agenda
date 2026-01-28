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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->foreignId('tipo_evento_id')->constrained('tipos_evento')->onDelete('restrict');
            $table->foreignId('dependencia_id')->constrained('dependencias')->onDelete('restrict');
            $table->string('otra_dependencia')->nullable();
            $table->foreignId('organizador_id')->constrained('organizadores')->onDelete('restrict');
            $table->text('notas_cta')->nullable();
            $table->text('notas_servicios_generales')->nullable();
            $table->foreignId('institucion_id')->constrained('instituciones')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();

            // Índices
            $table->index('tipo_evento_id');
            $table->index('dependencia_id');
            $table->index('organizador_id');
            $table->index('institucion_id');
            $table->index('usuario_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
