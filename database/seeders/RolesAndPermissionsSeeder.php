<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar cache de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos siguiendo el patrón recurso.acción
        $permissions = [
            // Eventos
            'eventos.ver',
            'eventos.crear',
            'eventos.editar',
            'eventos.eliminar',
            
            // Usuarios
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',
            
            // Catálogos
            'catalogos.ver',
            'catalogos.editar',
            
            // Reportes
            'reportes.ver',
            'reportes.generar',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Rol: Administrador
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $adminRole->syncPermissions(Permission::all());

        // Rol: Editor
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $editorRole->syncPermissions([
            'eventos.ver',
            'eventos.crear',
            'eventos.editar',
            'catalogos.ver',
        ]);

        // Rol: Consultor
        $consultorRole = Role::firstOrCreate(['name' => 'consultor']);
        $consultorRole->syncPermissions([
            'eventos.ver',
            'reportes.ver',
            'reportes.generar',
        ]);

        // Crear usuario administrador por defecto
        $admin = User::firstOrCreate(
            ['email' => 'admin@cucsh.udg.mx'],
            [
                'name' => 'Administrador CUCSH',
                'password' => bcrypt('admin123'),
            ]
        );
        $admin->assignRole('administrador');

        $this->command->info('Roles y permisos creados exitosamente.');
    }
}
