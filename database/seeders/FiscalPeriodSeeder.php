<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiscalPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fiscal_periods')->updateOrInsert([
            'id' => 1
        ], [
            'start_period' => '2022-06-01',
            'end_period' => '2023-05-01',
            'is_active' => 1
        ]);
    }
}
