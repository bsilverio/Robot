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
            'first_name' => 'Benjamin Joseph',
            'last_name' => 'Silverio',
            'email' => 'benjosilverio@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
