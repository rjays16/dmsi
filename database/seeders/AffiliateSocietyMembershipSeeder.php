<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliateSocietyMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliate_society_memberships = [
            "Philippine Dermatological Society",
            "Philippine Neurological Society",
            "Philippine Academy of Ophthalmology, Inc",
            "Philippine Orthopedic Association",
            "Philippine Society of Otolaryngology and Head and Neck Surgery",
            "Philippine Psychiatric Association",
            "Philippine Academy of Rehabilitation Medicine",
            "General Practitioner",
            "Government Physician (DOH, PHIC, PNP, AFP, CHO, IPHD, etc.)",
            "Retiree",
            "Resident Physician in Training"
        ];

        foreach($affiliate_society_memberships as $key => $membership) {
            DB::table('affiliate_society_memberships')->updateOrInsert([
                'id' => $key+1
            ], [
                'name' => $membership
            ]);
        }
    }
}
