<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Topic::class, 1000)->create()->each(function($topic)
        {
          $topic->save();
        });
    }
}
