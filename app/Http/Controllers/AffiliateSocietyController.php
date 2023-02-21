<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AffiliateSocietyMemberships;
use App\Models\PCRMember;

class AffiliateSocietyController extends Controller
{
    public function getMembers($id) {
        $society = AffiliateSocietyMemberships::where('id', $id)->first();

        if(!is_null($society)) {
            $members = PCRMember::where('affi_soc_mem_type', $id)->paginate(20);

            if($members->isNotEmpty()) {
                return response()->json([
                    'society_name' => $society->name,
                    'members' => $members
                ]);
            } else {
                return response()->json([
                    'message' => 'No members from this Affiliate Society were found.'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Affiliate Society not found.'
            ], 404);
        }
    }
}