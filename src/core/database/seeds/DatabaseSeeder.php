<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('robot_usersph')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => 'benjosilverio@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
