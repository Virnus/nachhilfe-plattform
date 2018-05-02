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
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'Lehrer'],
            ['name' => 'Schueler']
        ]);

        DB::table('ausbildungs')->insert([
          ['name' => 'WMS'],
          ['name' => 'GYM'],
          ['name' => 'IMS']
        ]);


        $this->call(UserTableSeeder::class);
        $this->call(LernzentrumSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(TopicSeeder::class);
    }
}
