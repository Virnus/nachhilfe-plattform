<?php

use Faker\Generator as Faker;
use App\Angebot;



$factory->define(App\Angebot::class, function (Faker $faker) {
    $start = ['Nachhilfe in '];
    $mid = ['Algebra', 'Statistik', 'Epochen', 'FCE', 'CAE', 'Datenbank', 'DELF', 'Pronomen', 'Nachhaltigkeit', 'Marketing'];
    $mid2 = ['', '', '-Lehre', '-Prüfung'];
    $level = ['', '', ' auf Gym Level', ' auf Ims Level', ' auf Wms Level', ' auf BM Level'];

    return [
        'title' => "{$faker->randomElement($start)}{$faker->randomElement($mid)}{$faker->randomElement($mid2)}{$faker->randomElement($level)}",
        'info' => $faker->text,
        'user_id' => $faker->numberBetween(1, 102),
        'subject_id' => $faker->numberBetween(1, 6),
        'created_at' => $faker->dateTimeThisYear()
    ];
});
