<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session_user')->insert([
            [
                'session_id' => 1,
                'user_id' => 1,
            ],
            [
                'session_id' => 1,
                'user_id' => 2,
            ],
            [
                'session_id' => 1,
                'user_id' => 3,
            ],
            [
                'session_id' => 2,
                'user_id' => 1,
            ],
            [
                'session_id' => 3,
                'user_id' => 3,
            ],
        ]);
    }
}
