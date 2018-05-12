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
        factory(App\Angebot::class, 10)->create()->each(function($angebot)
        {
          $angebot->save();
        });
    }
}
