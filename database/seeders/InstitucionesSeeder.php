<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instituciones = [
            [
                'nombre' => 'Centro Universitario de Ciencias Sociales y Humanidades',
                'codigo' => 'CUCSH',
                'activo' => true,
            ],
            [
                'nombre' => 'Centro Universitario de Ciencias Exactas e Ingenierías',
                'codigo' => 'CUCEI',
                'activo' => true,
            ],
            [
                'nombre' => 'Centro Universitario de Ciencias de la Salud',
                'codigo' => 'CUCS',
                'activo' => true,
            ],
            [
                'nombre' => 'Centro Universitario de Ciencias Económico Administrativas',
                'codigo' => 'CUCEA',
                'activo' => true,
            ],
            [
                'nombre' => 'Centro Universitario de Arte, Arquitectura y Diseño',
                'codigo' => 'CUAAD',
                'activo' => true,
            ],
            [
                'nombre' => 'Centro Universitario de Ciencias Biológicas y Agropecuarias',
                'codigo' => 'CUCBA',
                'activo' => true,
            ],
        ];

        foreach ($instituciones as $institucion) {
            DB::table('instituciones')->updateOrInsert(
                ['codigo' => $institucion['codigo']],
                array_merge($institucion, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('Instituciones creadas exitosamente.');
    }
}
