<?php

use Illuminate\Database\Seeder;
use App\Angebot;

class AngebotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Angebot::class, 50)->create()->each(function($angebot)
        {
          $angebot->topics()->save(factory(App\Topic::class)->make());
        });
    }
}
