<?php

use App\Alert;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alerts')->insert([
            'user_id' => 1,
            'sender_id' => 2,
            'created_at'=> now()
        ]);
        DB::table('alerts')->insert([
            'user_id' => 2,
            'sender_id' => 1,
            'created_at'=> now()
        ]);
    }
}
