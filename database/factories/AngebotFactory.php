<?php

use Faker\Generator as Faker;
use App\Angebot;

$factory->define(App\Angebot::class, function (Faker $faker) {
    return [
        'info' => $faker->text,
        'provider_id' => $faker->numberBetween(1, 102),
        'subject_id' => $faker->numberBetween(1, 6),
    ];
});
