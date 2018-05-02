<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
          ['name' => 'Deutsch'],
          ['name' => 'Französisch'],
          ['name' => 'Informatik'],
          ['name' => 'Englisch'],
          ['name' => 'Mathematik'],
          ['name' => 'Geschichte'],
        ]);
    }
}
