<?php

use Illuminate\Database\Seeder;

class LernzentrumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lernzentrum::class, 10)->create()->each(function($lernzentrum)
        {
          $lernzentrum->save();
        });
    }
}
