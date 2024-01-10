<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10000) as $id) {
            $model = CarModel::query()->where('id', $id);

            if (!$model->exists()) {
                return;
            }

            $car = Car::query()->create([
                'car_trim_list_id' => $model->first()->trims()->inRandomOrder()->first()->getKey(),
            ]);

            $car->detail()->create([
                'color' => \App\Models\Color::query()->inRandomOrder()->first()->hex,
                'price' => (rand(1, 9) * 10000) + (rand(1, 9) * 1000),
            ]);
        }
    }
}
