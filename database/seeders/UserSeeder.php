<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'last_name' => 'SÉGALEN',
                'first_name' => 'Thomas',
                'email' => 'thomas@vote.fr',
                'password' => Hash::make('thomas'),
                'avatar' => null,
                'title_id' => Title::MAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'last_name' => 'SÉGALEN',
                'first_name' => 'Marie',
                'email' => 'marie@vote.fr',
                'password' => Hash::make('marie'),
                'avatar' => null,
                'title_id' => Title::WOMAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'last_name' => 'SÉGALEN',
                'first_name' => 'Jérôme',
                'email' => 'jerome@vote.fr',
                'password' => Hash::make('jerome'),
                'avatar' => null,
                'title_id' => Title::MAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
