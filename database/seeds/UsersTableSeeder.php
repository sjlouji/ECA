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
            'name' => 'joan',
            'email' => 'joanlouji.20it@licet.ac.in',
            'password' => bcrypt('admin'),
        ]);
    }
}
