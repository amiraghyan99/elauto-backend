<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use App\Models\CarModelList;
use Faker\Core\Color;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'panel',
        ]);
        $user->assignRole($role);

        $this->call(CarListsSeeder::class);

        foreach (range(1, 10000) as $id) {
            if (! CarModelList::query()->where('id', $id)->exists()) {
                return;
            }

            $car = Car::query()->create([
                'car_model_list_id' => $id,
            ]);
            $car->details()->create([
                'color' => (new Color())->hexColor(),
            ]);
        }

    }
}
