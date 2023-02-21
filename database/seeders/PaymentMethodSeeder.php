<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->updateOrInsert([
            'id' => 1
        ], [
            'name' => 'Ideapay'
        ]);

        DB::table('payment_methods')->updateOrInsert([
            'id' => 2
        ], [
            'name' => 'Bank'
        ]);

        DB::table('payment_methods')->updateOrInsert([
            'id' => 3
        ], [
            'name' => 'Check'
        ]);
    }
}
