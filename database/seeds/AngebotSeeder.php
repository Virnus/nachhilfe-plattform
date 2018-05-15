<?php

use Illuminate\Database\Seeder;
use App\Angebot;

use Faker\Factory as Faker;

class AngebotSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        factory(App\Angebot::class, 50)->create()->each(function($angebot) use ($faker)
        {
            $angebot->save();

            $angebot->topics()->sync(
                [
                    $faker->numberBetween(0, 50),
                    $faker->optional(0.4, 0)->numberBetween(0, 50),
                    $faker->optional(0.1, 0)->numberBetween(0, 50)
                ]
            );
        });
    }
}
