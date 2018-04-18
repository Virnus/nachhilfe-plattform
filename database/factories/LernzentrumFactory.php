<?php

use Faker\Generator as Faker;

$factory->define(App\Lernzentrum::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('+0 days', '+2 years'),
        'info' => $faker->text,
        'room' => $faker->city,
        'max_participants' => 20,
        'teacher_id' => $faker->numberBetween(1, 102)
    ];
});
