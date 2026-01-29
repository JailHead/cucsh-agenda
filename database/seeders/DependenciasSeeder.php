<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DependenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dependencias = [
            [
                'nombre' => 'Secretaría Académica',
                'email_notificacion' => 'academica@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Secretaría Administrativa',
                'email_notificacion' => 'administrativa@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Coordinación de Extensión',
                'email_notificacion' => 'extension@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Coordinación de Investigación',
                'email_notificacion' => 'investigacion@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Difusión Cultural',
                'email_notificacion' => 'cultura@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Servicios Generales',
                'email_notificacion' => 'servicios@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Biblioteca',
                'email_notificacion' => 'biblioteca@cucsh.udg.mx',
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Estudios Políticos',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Estudios de Comunicación Social',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Filosofía',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Letras',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Psicología',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Sociología',
                'email_notificacion' => null,
                'activo' => true,
            ],
            [
                'nombre' => 'Departamento de Trabajo Social',
                'email_notificacion' => null,
                'activo' => true,
            ],
        ];

        foreach ($dependencias as $dependencia) {
            DB::table('dependencias')->updateOrInsert(
                ['nombre' => $dependencia['nombre']],
                array_merge($dependencia, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('Dependencias creadas exitosamente.');
    }
}
