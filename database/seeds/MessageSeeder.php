<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Flat;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $flat_ids = Flat::pluck('id')->toArray();

        for ($i = 0; $i < 9; $i++) {

            $new_message = new Message();
            $new_message->flat_id = Arr::random($flat_ids);
            $new_message->sender_name = $faker->userName();
            $new_message->sender_email = $faker->email();
            $new_message->object = $faker->sentence();
            $new_message->text = $faker->text(500);

            $new_message->save();
        }
    }
}
