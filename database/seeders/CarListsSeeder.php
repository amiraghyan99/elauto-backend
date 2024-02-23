<?php

namespace Database\Seeders;

use App\Http\Integrations\Cars\CarsConnector;
use App\Http\Integrations\Cars\Requests\AllCarsRequest;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarType;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Saloon\Exceptions\Request\ClientException;

class CarListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = 2010;
        while ($year <= now()->year + 1) {

            $this->fetchCarsData($year);

            $year++;

        }
    }

    private function fetchCarsData(int $year): void
    {
        DB::beginTransaction();

        try {
            $connector = CarsConnector::make($year);

            $paginator = $connector->paginate(AllCarsRequest::make());

            foreach ($paginator->items() as $item) {

                $carMake = CarMake::query()->firstOrCreate(
                    ['name' => $item['make']]
                );

                $type = CarType::query()->firstOrCreate(
                    ['name' => $item['vclass']]
                );



                $model = $carMake->models()->firstOrCreate(
                    ['name' => $item['basemodel'], 'slug' => str($item['make'] . ' ' . $item['basemodel'])->slug()],
                    [
                        'car_type_id' => $type->getKey(),
                    ]
                );


                $slugName = $item['make'] . ' ' . $item['model'] . ' ' . $item['year'] . ' year';
                $model->trims()->create([
                    'name' => $item['model'],
                    'year' => $item['year'],
                    'slug' => str($slugName)->slug()
                    // 'class' => $item['vclass'],
                    // 'fuel_type' => $item['fueltype'],
                    // 'fuel_type_dscr' => $item['fueltype1'],
                    // 'engine' => $item['displ'],
                    // 'time_charge_240' => $item['charge240'],
                    // 'cylinders' => $item['cylinders'],
                    // 'transmission_type' => explode(' ', $item['trany'])[0] === 'Automatic' ? 'A' : 'M',

                    // 'transmission' => str_replace(['(', ')'], '', explode(' ', $item['trany'])[1]),
                    // 'start_stop' => $item['startstop'] === 'Y',
                    // 'mpgdata' => $item['mpgdata'] === 'Y',
                    // 'drive' => $item['drive'],
                    // 'eng_dscr' => $item['eng_dscr'] ? implode(', ', $item['eng_dscr']) : null,
                ]);

                DB::commit();

            }
        } catch (ClientException $exception) {
            dd($exception);
            DB::rollBack();
        } catch (Exception $exception) {
            dump($exception->getMessage());
        }
    }
}
