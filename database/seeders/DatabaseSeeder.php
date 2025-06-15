<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Criação das permissões
        Permission::create(['name' => 'Gerenciar unidades']);
        Permission::create(['name' => 'Gerenciar entregas']);
        Permission::create(['name' => 'Gerenciar usuários']);
        Permission::create(['name' => 'Dashboard']);

        //Criação dos perfis
        $administrador = Role::create(['name' => 'Administrador']);
        $operador = Role::create(['name' => 'Operador']);

        //Atribuindo permissões aos usuários.
        $administrador->givePermissionTo([
            'Gerenciar unidades',
            'Gerenciar entregas',
            'Gerenciar usuários',
            'Dashboard'
        ]);

        $operador->givePermissionTo([
            'Gerenciar unidades',
            'Gerenciar entregas',
        ]);

        $user = User::create([
            'name' => 'Administrador',
            'surname' => 'Master',
            'email' => 'admin@e-locker.online',
            'password' => bcrypt('master$;'),
            'profile' => 'Administrador'
        ]);
    
        $user->assignRole('Administrador');
    }
}
