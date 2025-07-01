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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_inscripcion', 20)->unique();
            $table->string('nombre', 100);
            $table->string('cedula', 20)->unique();
            $table->string('email', 100);
            $table->string('telefono', 20);
            $table->enum('profesion', [
                'estudiante_pregrado',
                'estudiante_postgrado',
                'docente',
                'investigador',
                'profesional',
                'otro'
            ]);
            $table->dateTime('fecha_registro');
            $table->string('foto_path')->nullable();
            $table->timestamps();
            
            // Add indexes
            $table->index('cedula');
            $table->index('codigo_inscripcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
