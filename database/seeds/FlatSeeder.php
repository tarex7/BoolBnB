<?php

use App\User;
use App\Models\Flat;
use Illuminate\Support\Arr;
use Faker\Generator as Faker; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();

        for($i = 0;$i < 10;$i++)
     {
        $new_flat = new Flat();

        //$new_flat->user_id = Arr::random($user_ids);
        $new_flat->user_id = 1;
        $new_flat->title = $faker-> text(rand(5,30));
        $new_flat->description = $faker->sentence(rand(10,100));
        $new_flat->price_per_day = $faker->randomFloat(2, 50, 2000);
        $new_flat->square_mt = $faker->numberBetween(50, 1000);
        $new_flat->room_number = $faker->numberBetween(1,50);
        $new_flat->bed_number = $faker->numberBetween(1,10);
        $new_flat->bathroom_number = $faker->numberBetween(1,10);
        $new_flat->address = $faker->address();
        $new_flat->latitude = $faker->latitude($min = -90, $max = 90);
        $new_flat->longitude = $faker->longitude($min = -180, $max = 180);
        // $new_flat->image = $faker->imageUrl(300, 300, 'apartment', true);
        //$faker->image('public/storage/images',640,480, null, false);
        $new_flat->visible = $faker->boolean();

        $new_flat->save();

     }
    }
}
