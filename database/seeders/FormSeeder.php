<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
       foreach(range(1,20) as $i){
            Form::create([
            'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('##########'),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'gender' => $faker->randomElement(['male', 'female']),
        ]);
       }
    }
}
