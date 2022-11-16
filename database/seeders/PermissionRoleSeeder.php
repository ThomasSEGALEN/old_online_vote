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
                'permission_id' => Permission::USERS_VIEW_ANY,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::USERS_VIEW,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::USERS_CREATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::USERS_UPDATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::USERS_DELETE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW_ANY,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::ROLES_CREATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::ROLES_UPDATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::ROLES_DELETE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW_ANY,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::GROUPS_CREATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::GROUPS_UPDATE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::GROUPS_DELETE,
                'role_id' => Role::ADMIN,
            ],
            [
                'permission_id' => Permission::USERS_VIEW_ANY,
                'role_id' => Role::USER,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW_ANY,
                'role_id' => Role::USER,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW_ANY,
                'role_id' => Role::USER,
            ],
        ]);
    }
}
