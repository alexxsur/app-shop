<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
      	'name' => 'prueba4',
        'email' => 'prueba4@nomail.com',
        'password' => bcrypt('prueba4')
      ]);
    }
}
