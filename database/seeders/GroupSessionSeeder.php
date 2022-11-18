<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_session')->insert([
            [
                'group_id' => 1,
                'session_id' => 1,
            ],
            [
                'group_id' => 2,
                'session_id' => 2,
            ],
            [
                'group_id' => 2,
                'session_id' => 3,
            ],
            [
                'group_id' => 3,
                'session_id' => 3,
            ],
        ]);
    }
}
