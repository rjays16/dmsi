<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnualMembershipFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('annual_membership_fees')->updateOrInsert([
            'id' => 1
        ], [
            'year' => '2021',
            'amount' => 1500
        ]);

        DB::table('annual_membership_fees')->updateOrInsert([
            'id' => 2
        ], [
            'year' => '2022',
            'amount' => 1000
        ]);

        DB::table('annual_membership_fees')->updateOrInsert([
            'id' => 3
        ], [
            'year' => '2023',
            'amount' => 1000
        ]);

        DB::table('annual_membership_fees')->updateOrInsert([
            'id' => 4
        ], [
            'year' => '2024',
            'amount' => 1000
        ]);

        DB::table('annual_membership_fees')->updateOrInsert([
            'id' => 5
        ], [
            'year' => '2025',
            'amount' => 1000
        ]);
    }
}
