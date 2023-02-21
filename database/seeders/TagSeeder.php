<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->updateOrInsert([
            'id' => 1
        ], [
            'tag_name' => 'Admin'
        ]);

        DB::table('tags')->updateOrInsert([
            'id' => 2
        ], [
            'tag_name' => 'Default'
        ]);
    }
}
