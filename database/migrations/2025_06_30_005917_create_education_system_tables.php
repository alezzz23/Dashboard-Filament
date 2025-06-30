<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Create usuarios table
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->foreignId('rol_id')->constrained('roles');
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });

        // Create cursos table
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->foreignId('profesor_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->timestamps();
        });

        // Create inscripciones table
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_inscripcion', 20)->unique()->nullable();
            $table->string('nombre', 100);
            $table->string('cedula', 20)->unique();
            $table->string('email', 100);
            $table->string('telefono', 20);
            $table->string('profesion', 50);
            $table->dateTime('fecha_registro');
            $table->timestamps();
        });

        // Create estudiantes_cursos pivot table
        Schema::create('estudiantes_cursos', function (Blueprint $table) {
            $table->foreignId('estudiante_id')->constrained('usuarios');
            $table->foreignId('curso_id')->constrained('cursos');
            $table->timestamp('fecha_inscripcion')->useCurrent();
            
            $table->primary(['estudiante_id', 'curso_id']);
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['nombre' => 'admin', 'descripcion' => 'Administrador del sistema'],
            ['nombre' => 'profesor', 'descripcion' => 'Profesor con acceso a cursos asignados'],
            ['nombre' => 'estudiante', 'descripcion' => 'Estudiante con acceso a sus cursos']
        ]);

        // Insert default admin user
        DB::table('usuarios')->insert([
            'nombre' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'rol_id' => 1,
            'activo' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_cursos');
        Schema::dropIfExists('inscripciones');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('roles');
    }
};
