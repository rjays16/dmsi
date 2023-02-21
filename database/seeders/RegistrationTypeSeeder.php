<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registration_types')->updateOrInsert([
            'id' => 1
        ], [
            'type_name' => 'PRC Member'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 2
        ], [
            'type_name' => 'Resident-in-training'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 3
        ], [
            'type_name' => 'Non PCR Member'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 4
        ], [
            'type_name' => 'Fellow-in-training'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 5
        ], [
            'type_name' => 'RadTech'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 6
        ], [
            'type_name' => 'Foreign Delegate'
        ]);
        DB::table('registration_types')->updateOrInsert([
            'id' => 7
        ], [
            'type_name' => 'Other'
        ]);
    }
}
