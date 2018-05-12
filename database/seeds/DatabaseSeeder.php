<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->call(UserTableSeeder::class);
        $this->call(LernzentrumSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(AngebotSeeder::class);
    }
}
