<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            [
                'role_id' => Role::ADMIN,
                'user_id' => 1,
            ],
            [
                'role_id' => Role::USER,
                'user_id' => 2,
            ],
        ]);
    }
}
