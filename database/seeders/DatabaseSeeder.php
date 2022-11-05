<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        DB::table('roles')->insert(
            [
                ['name' => 'master'],
                ['name' => 'admin'],
                ['name' => 'singer'],
                ['name' => 'user'],
            ]
        );
        DB::table('permissions')->insert(
            [
                ['name' => 'crud_manager'],
                ['name' => 'manager'],
                ['name' => 'singer'],
            ]
        );
        DB::table(('role_permission'))->insert(
            [
                ['role_id' => 1 , 'permission_id' => 1],
                ['role_id' => 1 , 'permission_id' => 2],
                ['role_id' => 1 , 'permission_id' => 3],

                ['role_id' => 2 , 'permission_id' => 2],
                ['role_id' => 2 , 'permission_id' => 3],

                ['role_id' => 3 , 'permission_id' => 3],
            ]
        );
    }
}
