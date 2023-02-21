<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collection_fees')->updateOrInsert([
            'id' => 3
        ], [
            'payment_type' => 1,
            'year' => '2021',
            'description' => 'Membership Fee',
            'amount' => 1500,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 22
        ], [
            'payment_type' => 2,
            'year' => '2021',
            'description' => 'PMA Membership Fee',
            'amount' => 1500,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 24
        ], [
            'payment_type' => 5,
            'year' => '2021',
            'description' => 'Good Standing Certificate Fee',
            'amount' => 200,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 37
        ], [
            'payment_type' => 1,
            'year' => '2021',
            'description' => 'MDMSI Election Eligibility',
            'amount' => 1,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 38
        ], [
            'payment_type' => 1,
            'year' => '2021',
            'description' => 'MDMSI Life Member Fee',
            'amount' => 1,
            'status' => true
        ]);
        
        DB::table('collection_fees')->updateOrInsert([
            'id' => 39
        ], [
            'payment_type' => 1,
            'year' => '2022',
            'description' => 'Membership Fee',
            'amount' => 1000,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 40
        ], [
            'payment_type' => 2,
            'year' => '2022',
            'description' => 'PMA Membership Fee',
            'amount' => 1500,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 41
        ], [
            'payment_type' => 5,
            'year' => '2022',
            'description' => 'Good Standing Certificate Fee',
            'amount' => 200,
            'enable_deposit_slip' => false,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 42
        ], [
            'payment_type' => 3,
            'year' => '2022',
            'description' => 'Platform Computerization Fee',
            'amount' => 500,
            'enable_deposit_slip' => false,
            'status' => true
        ]);

        DB::table('collection_fees')->updateOrInsert([
            'id' => 43
        ], [
            'payment_type' => 2,
            'year' => '2022',
            'description' => 'PMA Membership Fee (New Members)',
            'amount' => 1500,
            'status' => true
        ]);
    }
}
