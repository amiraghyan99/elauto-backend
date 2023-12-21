<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'panel',
        ]);
        $user->assignRole($role);

        //        $this->call(CountrySeeder::class);
        //        $this->call(StateSeeder::class);
        //        $this->call(CitySeeder::class);
        $this->call(CarSeeder::class);
    }
}
