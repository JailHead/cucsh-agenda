<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Iniciando seeding de la base de datos...');
        
        // Orden de ejecución: primero tablas independientes, luego dependientes
        $this->call([
            RolesAndPermissionsSeeder::class,
            InstitucionesSeeder::class,
            TiposEventoSeeder::class,
            DependenciasSeeder::class,
        ]);

        $this->command->info('Seeding completado exitosamente.');
        $this->command->newLine();
        $this->command->info('Credenciales del administrador:');
        $this->command->info('Email: admin@cucsh.udg.mx');
        $this->command->info('Contraseña: admin123');
        $this->command->warn('IMPORTANTE: Cambia la contraseña después del primer login.');
    }
}
