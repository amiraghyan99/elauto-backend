<?php

namespace Database\Seeders;

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
        $this->call(ColorSeeder::class);

        \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'panel',
        ]);

        // $customerRole = Role::create([
        //     'name' => 'customer',
        // ]);

        $adminPermission = Permission::create([
            'name' => 'access',
            'guard_name' => 'panel'
        ]);

        $adminRole->givePermissionTo($adminPermission);

        $user->assignRole(
            $adminRole,
            // $customerRole
        );

        // $this->call(CarListsSeeder::class);
        // $this->call(CarsSeeder::class);

    }
}
