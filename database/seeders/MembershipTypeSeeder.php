<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_types')->updateOrInsert([
            'id' => 1
        ], [
            'type_name' => 'Regular'
        ]);

        DB::table('membership_types')->updateOrInsert([
            'id' => 2
        ], [
            'type_name' => 'Life Member'
        ]);

        DB::table('membership_types')->updateOrInsert([
            'id' => 3
        ], [
            'type_name' => 'Emeritus'
        ]);

        DB::table('membership_types')->updateOrInsert([
            'id' => 4
        ], [
            'type_name' => 'Honorary (non-voting)'
        ]);

        DB::table('membership_types')->updateOrInsert([
            'id' => 5
        ], [
            'type_name' => 'Affiliate (non-voting)'
        ]);
    }
}
