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
        //

        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email'    => 'admin@social-forum.dev',
            'admin'   => 1,
            'avatar'  => asset('avatars/avatar.png')

        ]);

        App\User::create([
            'name' => 'Emily Myres',
            'password' => bcrypt('password'),
            'email'    => 'emily@myres.com',
            'avatar'  => asset('avatars/avatar.png')

        ]);
    }


}