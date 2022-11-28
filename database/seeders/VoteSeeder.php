<?php

namespace Database\Seeders;

use App\Models\VoteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votes')->insert([
            [
                'title' => 'Vote 1',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'status' => true,
                'session_id' => 1,
                'type_id' => VoteType::PUBLIC,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Vote 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'status' => true,
                'session_id' => 2,
                'type_id' => VoteType::SECRET,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Vote 3',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'status' => false,
                'session_id' => 3,
                'type_id' => VoteType::PUBLIC,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
