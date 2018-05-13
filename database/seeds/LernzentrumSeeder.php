<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LernzentrumSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        factory(App\Lernzentrum::class, 10)->create()->each(function($lernzentrum) use ($faker)
        {
            $lernzentrum->save();

            $lernzentrum->assistants()->sync(
                [
                    $faker->numberBetween(0, 100),
                    $faker->numberBetween(0, 100),
                    $faker->numberBetween(0, 100)
                ]
            );
        });
    }
}
