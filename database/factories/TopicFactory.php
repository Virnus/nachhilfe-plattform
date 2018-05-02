<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'subject_id' => $faker->numberBetween(1, 6)
    ];
});
