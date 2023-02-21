<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsor_type')->updateOrInsert([
            'id' => 1
        ], [
            'type_name' => 'Platinum'
        ]);

        DB::table('sponsor_type')->updateOrInsert([
            'id' => 2
        ], [
            'type_name' => 'Gold'
        ]);

        DB::table('sponsor_type')->updateOrInsert([
            'id' => 3
        ], [
            'type_name' => 'Silver'
        ]);

        DB::table('sponsor_type')->updateOrInsert([
            'id' => 4
        ], [
            'type_name' => 'Bronze'
        ]);

        DB::table('sponsor_type')->updateOrInsert([
            'id' => 5
        ], [
            'type_name' => 'Event'
        ]);
    }
}
