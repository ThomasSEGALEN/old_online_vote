<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Primary tables
        // $this->call([
        //     SessionSeeder::class,
        //     GroupSeeder::class,
        //     PermissionSeeder::class,
        //     RoleSeeder::class,
        //     TitleSeeder::class,
        //     UserSeeder::class,
        // ]);

        // Pivot tables
        // $this->call([
        //     PermissionRoleSeeder::class,
        //     PermissionUserSeeder::class,
        //     GroupUserSeeder::class,
        //     GroupSessionSeeder::class,
        //     SessionUserSeeder::class,
        // ]);
    }
}
