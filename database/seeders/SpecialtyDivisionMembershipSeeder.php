<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtyDivisionMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialty_division_memberships = [
            "Philippine Society of Anesthesiologists, Inc - SMC",
            "Philippine Academy of Family Physicians - SMC",
            "Philippine Obstetrical and Gynecological Society - SMC",
            "Philippine College of Physicians - SMC",
            "Philippine Society of Pathologists",
            "Philippine Pediatric Society - SMC",
            "Philippine College of Radiology - SMC",
            "Philippine College of Surgery - SMC",
        ];

        foreach($specialty_division_memberships as $key => $membership) {
            DB::table('specialty_division_memberships')->updateOrInsert([
                'id' => $key+1
            ], [
                'name' => $membership
            ]);
        }
    }
}
