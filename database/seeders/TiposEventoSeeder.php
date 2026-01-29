<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposEvento = [
            ['nombre' => 'Conferencia', 'activo' => true],
            ['nombre' => 'Taller', 'activo' => true],
            ['nombre' => 'Seminario', 'activo' => true],
            ['nombre' => 'Curso', 'activo' => true],
            ['nombre' => 'Coloquio', 'activo' => true],
            ['nombre' => 'Congreso', 'activo' => true],
            ['nombre' => 'Simposio', 'activo' => true],
            ['nombre' => 'Presentación de libro', 'activo' => true],
            ['nombre' => 'Exposición', 'activo' => true],
            ['nombre' => 'Mesa redonda', 'activo' => true],
            ['nombre' => 'Ceremonia', 'activo' => true],
            ['nombre' => 'Actividad cultural', 'activo' => true],
            ['nombre' => 'Actividad deportiva', 'activo' => true],
            ['nombre' => 'Reunión académica', 'activo' => true],
            ['nombre' => 'Otro', 'activo' => true],
        ];

        foreach ($tiposEvento as $tipo) {
            DB::table('tipos_evento')->updateOrInsert(
                ['nombre' => $tipo['nombre']],
                array_merge($tipo, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('Tipos de evento creados exitosamente.');
    }
}
