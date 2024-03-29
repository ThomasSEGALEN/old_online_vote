<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\UserTitle;
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
                'last_name' => 'Ségalen',
                'first_name' => 'Thomas',
                'email' => 'thomas@vote.fr',
                'password' => Hash::make('thomas'),
                'avatar' => null,
                'role_id' => Role::ADMIN,
                'title_id' => UserTitle::MAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'last_name' => 'Ségalen',
                'first_name' => 'Marie',
                'email' => 'marie@vote.fr',
                'password' => Hash::make('marie'),
                'avatar' => null,
                'role_id' => Role::USER,
                'title_id' => UserTitle::WOMAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'last_name' => 'Ségalen',
                'first_name' => 'Jérôme',
                'email' => 'jerome@vote.fr',
                'password' => Hash::make('jerome'),
                'avatar' => null,
                'role_id' => Role::USER,
                'title_id' => UserTitle::MAN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
