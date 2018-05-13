<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    $start = ['','', 'Grundlagen in ', 'Schwerpunkte der ', 'Erweiterung der ', 'Erste Schritte '];
    $mid = ['Algebra', 'Statistik', 'Epochen', 'FCE', 'CAE', 'Datenbank', 'DELF', 'Pronomen', 'Nachhaltigkeit', 'Marketing'];
    $mid2 = ['', '', '-Lehre', '-Prüfung'];
    $level = ['', '', ' auf Gym Level', ' auf Ims Level', ' auf Wms Level', ' auf BM Level'];

    return [
        'name' => "{$faker->randomElement($start)}{$faker->randomElement($mid)}{$faker->randomElement($mid2)}{$faker->randomElement($level)}",
        'subject_id' => $faker->numberBetween(1, 6)
    ];
});
