<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModelList;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10000) as $id) {
            $model = CarModelList::query()->where('id', $id);

            if (!$model->exists()) {
                return;
            }

            $car = Car::query()->create([
                'car_feature_list_id' => $model->first()->features()->inRandomOrder()->first()->getKey(),
            ]);

            $car->details()->create([
                'color' => \App\Models\Color::query()->inRandomOrder()->first()->hex,
                'price' => (rand(1, 9) * 10000) + (rand(1, 9) * 1000),
            ]);
        }
    }
}
