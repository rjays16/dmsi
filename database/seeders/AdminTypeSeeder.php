<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_types')->updateOrInsert([
            'id' => 1
        ], [
            'type_name' => 'Super Admin'
        ]);

        DB::table('admin_types')->updateOrInsert([
            'id' => 2
        ], [
            'type_name' => 'Executive Committee'
        ]);

        DB::table('admin_types')->updateOrInsert([
            'id' => 3
        ], [
            'type_name' => 'Sponsor'
        ]);

        DB::table('admin_types')->updateOrInsert([
            'id' => 4
        ], [
            'type_name' => 'Attendee'
        ]);
    }
}
