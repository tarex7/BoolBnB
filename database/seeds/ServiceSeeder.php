<?php

use App\Models\Service;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels =
            [
                'wi-fi',
                'giardino',
                'ascensore',
                'piscina',
                'aria condizionata',
                'vista mare',
                'vista montagna',
                'area fumatori',
                'TV',
                'cucina',

            ];
        foreach ($labels as $label) {

            $service = new Service();
            $service->label = $label;
            $service->icon = 'pippo';

            $service->save();
        }
    }
}
