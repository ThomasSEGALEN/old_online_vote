<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert([
            [
                'permission_id' => Permission::VIEW_ANY,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::VIEW,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::CREATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::UPDATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::DELETE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::VIEW_ANY,
                'role_id' => Role::USER,
            ],
        ]);
    }
}
