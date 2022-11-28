<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_user')->insert([
            [
                'permission_id' => Permission::USERS_VIEW_ANY,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::USERS_VIEW,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::USERS_CREATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::USERS_UPDATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::USERS_DELETE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW_ANY,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::ROLES_CREATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::ROLES_UPDATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::ROLES_DELETE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW_ANY,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::GROUPS_CREATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::GROUPS_UPDATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::GROUPS_DELETE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::SESSIONS_VIEW_ANY,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::SESSIONS_VIEW,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::SESSIONS_CREATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::SESSIONS_UPDATE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::SESSIONS_DELETE,
                'user_id' => 1,
            ],
            [
                'permission_id' => Permission::USERS_VIEW_ANY,
                'user_id' => 2,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW_ANY,
                'user_id' => 2,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW_ANY,
                'user_id' => 2,
            ],
            [
                'permission_id' => Permission::SESSIONS_VIEW_ANY,
                'user_id' => 2,
            ],
            [
                'permission_id' => Permission::USERS_VIEW_ANY,
                'user_id' => 3,
            ],
            [
                'permission_id' => Permission::ROLES_VIEW_ANY,
                'user_id' => 3,
            ],
            [
                'permission_id' => Permission::GROUPS_VIEW_ANY,
                'user_id' => 3,
            ],
            [
                'permission_id' => Permission::SESSIONS_VIEW_ANY,
                'user_id' => 3,
            ],
        ]);
    }
}
