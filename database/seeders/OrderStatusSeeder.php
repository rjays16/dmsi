<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->updateOrInsert([
                'id' => 1
        ], [
                'name' => 'Pending'
        ]);

        DB::table('order_status')->updateOrInsert([
                'id' => 2
        ], [
                'name' => 'Completed'
        ]);

        DB::table('order_status')->updateOrInsert([
                'id' => 3
        ], [
                'name' => 'Failed'
        ]);
        
        DB::table('order_status')->updateOrInsert([
                'id' => 4
        ], [
                'name' => 'Partial'
        ]);

        DB::table('order_status')->updateOrInsert([
                'id' => 5
        ], [
                'name' => 'For Approval'
        ]);
    }
}
