<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'username' => 'Melo',
        	'email' => 'mail@mail.com',
        	'admin' => 1,
        	'password' => bcrypt('admin')
        ]);
    }
}
