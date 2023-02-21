<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([
            'id' => 1
        ], [
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin',
            'userable_type' => 'App\Models\User',
            'userable_id' => 0,
            'tag_id' => 1
        ]);

        DB::table('users')->updateOrInsert([
            'id' => 2
        ], [
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'super_admin',
            'userable_type' => 'App\Models\User',
            'userable_id' => 0,
            'tag_id' => 1
        ]);

        DB::table('users')->updateOrInsert([
            'id' => 3
        ], [
            'email' => 'admin_pcr@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin_pcr',
            'userable_type' => 'App\Models\User',
            'userable_id' => 0,
            'tag_id' => 1
        ]);

        DB::table('users')->updateOrInsert([
            'id' => 4
        ], [
            'email' => 'admin_convention@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin_convention',
            'userable_type' => 'App\Models\User',
            'userable_id' => 0,
            'tag_id' => 1
        ]);
    }
}
