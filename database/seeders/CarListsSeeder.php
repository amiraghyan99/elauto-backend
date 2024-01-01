<?php

namespace Database\Seeders;

use App\Http\Integrations\Cars\CarsConnector;
use App\Http\Integrations\Cars\Requests\AllCarsRequest;
use App\Models\CarMakeList;
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

    /**
     * @throws \Throwable
     */
    private function fetchCarsData(int $year): void
    {
        DB::beginTransaction();

        try {
            $connector = CarsConnector::make($year);

            $paginator = $connector->paginate(AllCarsRequest::make());

            foreach ($paginator->items() as $item) {

                $carMake = CarMakeList::query()->firstOrCreate(
                    ['name' => $item['make']],
                    ['name' => $item['make']]
                );

                $model = $carMake->models()->firstOrCreate(
                    ['name' => $item['model']],
                    ['name' => $item['model']]
                );

                $model->features()->create([
                    'class' => $item['vclass'],
                    'fuel_type' => $item['fueltype'],
                    'fuel_type_dscr' => $item['fueltype1'],
                    'year' => $item['year'],
                    'engine' => $item['displ'],
                    'time_charge_240' => $item['charge240'],
                    'cylinders' => $item['cylinders'],
                    'transmission' => $item['trany'],
                    'start_stop' => $item['startstop'] === 'Y',
                    'mpgdata' => $item['mpgdata'] === 'Y',
                    'drive' => $item['drive'],
                    'eng_dscr' => $item['eng_dscr'] ? implode(', ', $item['eng_dscr']) : null,
                ]);

                DB::commit();
            }
        } catch (ClientException $exception) {
            dd($exception);
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }
}
