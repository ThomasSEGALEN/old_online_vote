<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vote_answers')->insert([
            [
                'name' => 'Oui',
                'color' => '#0000ff',
                'amount' => 2,
                'order' => 0,
                'vote_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Non',
                'color' => '#ff0000',
                'amount' => 1,
                'order' => 1,
                'vote_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pour',
                'color' => '#0000ff',
                'amount' => 1,
                'order' => 0,
                'vote_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Contre',
                'color' => '#ff0000',
                'amount' => 2,
                'order' => 1,
                'vote_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Favorable',
                'color' => '#0000ff',
                'amount' => 3,
                'order' => 0,
                'vote_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Défavorable',
                'color' => '#ff0000',
                'amount' => 0,
                'order' => 1,
                'vote_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
