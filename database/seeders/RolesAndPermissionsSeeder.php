<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
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
            'catalogos.crear',
            'catalogos.editar',
            'catalogos.eliminar',
            
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
            'catalogos.ver',
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

        $editor = User::firstOrCreate(
            ['email' => 'editor@cucsh.udg.mx'],
            [
                'name' => 'Editor CUCSH',
                'password' => Hash::make('editor123'),
            ]
        );
        $editor->assignRole('editor');

        // Crear usuario consultor de prueba
        $consultor = User::firstOrCreate(
            ['email' => 'consultor@cucsh.udg.mx'],
            [
                'name' => 'Consultor CUCSH',
                'password' => Hash::make('consultor123'),
            ]
        );
        $consultor->assignRole('consultor');

        echo "\n=== Usuarios de prueba creados ===\n";
        echo "Administrador: admin@cucsh.udg.mx / admin123\n";
        echo "Editor: editor@cucsh.udg.mx / editor123\n";
        echo "Consultor: consultor@cucsh.udg.mx / consultor123\n";
    }
}
