<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(6),
            'email' => str_random(6),
            'player' => str_random(6),
            'phone' => 444,
            'password' => Hash::make('asdf')
        ]);

        DB::table('users')->insert([
            'name' => str_random(6),
            'email' => str_random(6),
            'player' => str_random(6),
            'phone' => 444,
            'password' => Hash::make('asdf')
        ]);
    }
}
