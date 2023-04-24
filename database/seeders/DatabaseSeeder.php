<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

       $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@example.com',
        ]);

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Intervenant']);
        $role3 = Role::create(['name' => 'Utilisateur simple']);
        $permission1 = Permission::create(['name' => 'Lecture']);
        $permission2 = Permission::create(['name' => 'Créer']);
        $permission3 = Permission::create(['name' => 'Modifier']);
        $permission4 = Permission::create(['name' => 'Supprimer']);
        $role1->givePermissionTo([$permission1,$permission2,$permission3,$permission4]);
        $role2->givePermissionTo([$permission1,$permission2,$permission3,$permission4]);
        $role3->givePermissionTo([$permission1,$permission3]);
        $user->assignRole($role1);
    }
}
