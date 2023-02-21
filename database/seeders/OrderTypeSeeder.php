<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_types')->updateOrInsert([
            'id' => 1
        ], [
            'name' => 'Membership',
            'order_number' => 1
        ]);

        DB::table('order_types')->updateOrInsert([
            'id' => 2
        ], [
            'name' => 'PMA',
            'order_number' => 2
        ]);

        DB::table('order_types')->updateOrInsert([
            'id' => 3
        ], [
            'name' => 'Computerization fee',
            'order_number' => 3
        ]);

        DB::table('order_types')->updateOrInsert([
            'id' => 4
        ], [
            'name' => 'Seminar fee',
            'order_number' => 4
        ]);

        DB::table('order_types')->updateOrInsert([
            'id' => 5
        ], [
            'name' => 'Others',
            'order_number' => 6
        ]);

        DB::table('order_types')->updateOrInsert([
            'id' => 6
        ], [
            'name' => 'Good Standing Certificate',
            'order_number' => 5
        ]);
    }
}
