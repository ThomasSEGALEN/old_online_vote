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
                'vote_id' => 1,
            ],
            [
                'name' => 'Non',
                'vote_id' => 1,
            ],
            [
                'name' => 'Pour',
                'vote_id' => 2,
            ],
            [
                'name' => 'Contre',
                'vote_id' => 2,
            ],
            [
                'name' => 'Favorable',
                'vote_id' => 3,
            ],
            [
                'name' => 'Défavorable',
                'vote_id' => 3,
            ],
        ]);
    }
}
