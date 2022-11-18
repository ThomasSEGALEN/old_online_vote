<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->insert([
            [
                'title' => 'Séance 1',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'start_date' => date('Y-m-d H:i:s'),
                'end_date' => date('2022-12-31 08:00:00'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Séance 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'start_date' => date('Y-m-d H:i:s'),
                'end_date' => date('2022-12-31 08:00:00'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Séance 3',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sunt corrupti unde libero natus tempora minima quos laudantium nam, dolorem corporis dignissimos quae vitae porro mollitia earum. Perferendis, enim consequuntur!',
                'start_date' => date('Y-m-d H:i:s'),
                'end_date' => date('2022-12-31 08:00:00'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
