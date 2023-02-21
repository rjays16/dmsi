<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdeapayStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ideapay_status')->updateOrInsert([
            'id' => 1
        ], [
            'name' => 'Pending'
        ]);

        DB::table('ideapay_status')->updateOrInsert([
            'id' => 2
        ], [
            'name' => 'Success'
        ]);

        DB::table('ideapay_status')->updateOrInsert([
            'id' => 3
        ], [
            'name' => 'Failed'
        ]);
    }
}
