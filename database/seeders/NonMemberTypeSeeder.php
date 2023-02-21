<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NonMemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('non_member_types')->updateOrInsert([
            'id' => 1
        ], [
            'non_member_name' => 'Non-PCR Member Physician'
        ]);

        DB::table('non_member_types')->updateOrInsert([
            'id' => 2
        ], [
            'non_member_name' => 'Allied Professional'
        ]);

        DB::table('non_member_types')->updateOrInsert([
            'id' => 3
        ], [
            'non_member_name' => 'Foreign Delegate'
        ]);
    }
}
