<?php

namespace Database\Seeders;

use App\Http\Integrations\Rapid\Cars;
use App\Http\Integrations\Rapid\Requests\CarModels;
use App\Http\Integrations\Rapid\Requests\Makes;
use App\Models\CarMake;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelsSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::beginTransaction();
        try {
            $conn = Cars::make();

            $response = $conn->send(new CarModels());

            $data = $response->json()['data'];
            dd($data);

            $makesArray = array_map(function ($make) {
                $make['slug'] = str($make['name'])->slug();
                return $make;
            }, $data);

            CarMake::query()->insert($makesArray);
        } catch (ClientException $e) {
            dump($e->getMessage());
            DB::rollBack();
        }
        DB::commit();
    }
}
