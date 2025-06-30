<?php

namespace Database\Seeders;

use App\Models\Inscripcion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscripcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar la revisión de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Vaciar la tabla si contiene datos
        Inscripcion::truncate();

        // Insertar datos de ejemplo
        $inscripciones = [
            [
                'codigo_inscripcion' => 'INSC-313840A0',
                'nombre' => 'Zulay Garcia',
                'cedula' => '18581164',
                'email' => 'traumaposthgo@gmail.com',
                'telefono' => '04147873203',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-07 20:13:04',
            ],
            [
                'codigo_inscripcion' => 'INSC-86D0FC89',
                'nombre' => 'William Enrique Jhelis Garcia',
                'cedula' => '17571240',
                'email' => 'jhelis2810@gmail.com',
                'telefono' => '04243011005',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 20:48:45',
            ],
            [
                'codigo_inscripcion' => 'INSC-7361DB9A',
                'nombre' => 'Cesar Astudillo',
                'cedula' => '16214269',
                'email' => 'cesarastudillo2@gmail.com',
                'telefono' => '04242282575',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 21:51:50',
            ],
            [
                'codigo_inscripcion' => 'INSC-7DC72BDD',
                'nombre' => 'Iván Cadena',
                'cedula' => 'E85000285',
                'email' => 'ivanrkdna@gmail.com',
                'telefono' => '04241390268',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 21:54:36',
            ],
            [
                'codigo_inscripcion' => 'INSC-881B864B',
                'nombre' => 'Jose Luis Alarcon Monasterio',
                'cedula' => '11412611',
                'email' => 'alarconmjose@gmail.com',
                'telefono' => '04265195041',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 21:57:21',
            ],
            [
                'codigo_inscripcion' => 'INSC-93769583',
                'nombre' => 'Abelardo Bachour',
                'cedula' => '20491880',
                'email' => 'doctor.bachour@gmail.com',
                'telefono' => '04141067450',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 22:00:23',
            ],
            [
                'codigo_inscripcion' => 'INSC-DA67C11D',
                'nombre' => 'Elder Madueño',
                'cedula' => 'V-23887035',
                'email' => 'elderdiegoz@gmail.com',
                'telefono' => '04126854088',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-14 22:19:18',
            ],
            [
                'codigo_inscripcion' => 'INSC-9733156F',
                'nombre' => 'José Bozo',
                'cedula' => '25371447',
                'email' => 'jbozofernandez@gmail.com',
                'telefono' => '04146910869',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-15 03:42:43',
            ],
            [
                'codigo_inscripcion' => 'INSC-6D00BF11',
                'nombre' => 'Jonathan José Cova',
                'cedula' => '23346423',
                'email' => 'de.jonathancova@gmail.com',
                'telefono' => '04248719580',
                'profesion' => 'especialista',
                'fecha_registro' => '2025-06-16 06:49:52',
            ],
        ];

        // Insertar los datos
        foreach ($inscripciones as $inscripcion) {
            Inscripcion::create($inscripcion);
        }

        // Reactivar la revisión de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info('Datos de inscripciones insertados correctamente.');
    }
}
