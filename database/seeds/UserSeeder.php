<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker; 
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $new_user = new User();
        $new_user->name = 'pippo';
        $new_user->email = 'pippo@pippo.com';
        $new_user->password = bcrypt('pippo');
        $new_user->save();


        for($i=0;$i < 9;$i++) {
            $new_user = new User();
            $new_user->name = $faker->userName();
            $new_user->email = $faker->email();
            $new_user->password = bcrypt('password');
            $new_user->first_name = $faker->firstName();
            $new_user->last_name = $faker->lastName();
            $new_user->birthdate = $faker->dateTime();
            $new_user->phone = $faker->phoneNumber();
            $new_user->save();
        }

    }
}
