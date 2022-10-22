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
        $services =
            [
                ['label'=>'wi-fi','icon'=>'fa-solid fa-wifi'],
                ['label'=>'Giardino','icon'=>'fa-solid fa-tree'],
                ['label'=>'Ascensore','icon'=>'fa-solid fa-elevator'],
                ['label'=>'Aria condizionata','icon'=>'fa-regular fa-snowflake'],
                ['label'=>'Vista mare','icon'=>'fa-solid fa-water'],
                ['label'=>'Vista montagna','icon'=>'fa-solid fa-mountain'],
                ['label'=>'Area fumatori','icon'=>'fa-solid fa-smoking'],
                ['label'=>'TV','icon'=>'fa-solid fa-tv'],
                ['label'=>'Cucina','icon'=>'fa-solid fa-kitchen-set'],
                
                
                
                

            ];
        foreach ($services as $service) {

            $new_service = new Service();
            $new_service->label = $service['label'];
            $new_service->icon = $service['icon'];

            $new_service->save();
        }
    }
}
