<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
          'name' => 'Serafin Lichtenhahn',
          'email' => 'seralichtenhahn@gmail.com',
          'password' =>  bcrypt('123456'),
          'remember_token' => str_random(10),
          'active' => true
        ]);

        App\User::create([
          'name' => 'Oliver Grun',
          'email' => 'olivergrun.og@gmail.com',
          'password' =>  bcrypt('123456'),
          'remember_token' => str_random(10),
          'active' => true
        ]);

        factory(App\User::class, 100)->create()->each(function($user)
        {
          $user->save();
        });
    }
}
