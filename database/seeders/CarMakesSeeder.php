<?php

namespace Database\Seeders;

use App\Http\Integrations\Cars\CarsConnector;
use App\Http\Integrations\Cars\Requests\CarMakesRequest;
use App\Http\Integrations\Rapid\Cars;
use App\Http\Integrations\Rapid\Requests\Makes;
use App\Models\CarMake;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarMakesSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::beginTransaction();
        try {
            $conn = CarsConnector::make();

            $response = $conn->paginate(new CarMakesRequest());
            foreach ($response->items() as $key => $item) {
                $make = CarMake::query()->firstOrCreate([
                    'name' => $item['make'],
                ]);
            }
            dd('END');

            // $data = $response->json()['data'];

            // $makesArray = array_map(function ($make) {
            //     $make['slug'] = str($make['name'])->slug();
            //     return $make;
            // }, $data);

            // CarMake::query()->insert($makesArray);
        } catch (ClientException $e) {
            dump($e->getMessage());
            DB::rollBack();
        }
        DB::commit();
    }
}
