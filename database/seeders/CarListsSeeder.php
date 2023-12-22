<?php

namespace Database\Seeders;

use App\Http\Integrations\Cars\CarsConnector;
use App\Http\Integrations\Cars\Requests\AllCarsRequest;
use App\Models\CarMakeList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->fetchCarsData();
        //        $this->setCarModelsAndFeatures();
    }

    private function fetchCarsData(): void
    {
        try {
            $connector = new CarsConnector();

            $paginator = $connector->paginate(AllCarsRequest::make());
            DB::beginTransaction();

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
                    'time_charge_240' => $item['charge240b'],
                    'cylinders' => $item['cylinders'],
                    'transmission' => $item['trany'],
                    'start_stop' => $item['startstop'] === 'Y',
                    'mpgdata' => $item['mpgdata'] === 'Y',
                    'drive' => $item['drive'],
                    'eng_dscr' => $item['eng_dscr'] ? implode(', ', $item['eng_dscr']) : null,
                ]);

            }
        } catch (\Saloon\Exceptions\Request\ClientException $exception) {
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
        }
        DB::commit();
    }
}
