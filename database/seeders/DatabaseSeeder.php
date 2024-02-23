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
        $this->call(ColorSeeder::class);

        \App\Models\User::factory(10)->create();

        $exampleUser = User::factory()->create([
            "name"=> "Example User",
            "email"=> "user@example.com",
        ]);

        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' =>bcrypt('supersecret')
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

        $adminUser->assignRole(
            $adminRole,
            // $customerRole
        );
        // $this->call(CarMakesSeeder::class);
        // $this->call(CarModelsSeeder::class);

        // $this->call(CarListsSeeder::class);
        // $this->call(CarsSeeder::class);

    }
}
