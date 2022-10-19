<?php

use Illuminate\Database\Seeder;
use App\Models\Flat;
use App\Models\View;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;


class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $flat_ids = Flat::pluck('id')->toArray();
        
        for($i=0;$i < 9;$i++) {
            

            $new_view = new View();
            $new_view->flat_id = Arr::random($flat_ids);
            $new_view->date = $faker->dateTimeBetween('-48 week','now');
            $new_view->IP = $faker->localIpv4();
            
         
            $new_view->save();
        }
    }
}
