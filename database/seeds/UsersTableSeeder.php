<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Amministratore',
            'surname' => 'Globale',
            'email' => 'info@example.it',
            'phone' => '348123456789',
            'password' => bcrypt('cippalippa'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Mario',
            'surname' => 'Rossi',
            'email' => 'mario@rossi.it',
            'phone' => '348123456789',
            'password' => bcrypt('cippalippa'),
            'role' => 'user'
        ]);
    }
}
