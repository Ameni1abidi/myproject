<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Création des rôles
        $adminRole = Role::create(['name' => 'admin']);
        $agentRole = Role::create(['name' => 'agent']); // tuteur
        $stagiaireRole = Role::create(['name' => 'stagiaire']);
        $userRole = Role::create(['name' => 'user']);

        // Assignation des permissions aux rôles
        $adminRole->givePermissionTo(Permission::all());
        $agentRole->givePermissionTo(['create users', 'edit users']);
        $stagiaireRole->givePermissionTo([]);
        $userRole->givePermissionTo([]);



        // Création de l'admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Vérifie si l'email existe déjà
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'), // Mot de passe par défaut
            ]
        );
        $admin->assignRole($adminRole);

        // Création d'un stagiaire
        $stagiaire = User::firstOrCreate(
            ['email' => 'stagiaire@gmail.com'],
            [
                'name' => 'Stagiaire',
                'password' => Hash::make('123456'),
            ]
        );
        $stagiaire->assignRole($stagiaireRole);

        // Création d'un utilisateur
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Utilisateur',
                'password' => Hash::make('123456'),
            ]
        );
        $user->assignRole($userRole);

        // Création d'un tuteur
        $tuteur = User::firstOrCreate(
            ['email' => 'tuteur@gmail.com'],
            [
                'name' => 'Tuteur',
                'password' => Hash::make('123456'),
            ]
        );
        $tuteur->assignRole($agentRole);

        $this->command->info('Roles and users seeded successfully!');
    }
}
