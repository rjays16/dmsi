<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationType;
use App\Models\MembershipType;
use App\Models\PRCNumber;
use App\Models\PCRChapter;
use App\Models\NonMemberType;
use App\Models\SpecialtyDivisionMembership;
use App\Models\AffiliateSocietyMemberships;

class FieldController extends Controller
{
    public function getAllRegistrationType()
    {
        return RegistrationType::all();
    }

    public function getMembershipTypes()
    {
        return MembershipType::all();
    }

    public function getAllNonMemberType()
    {
        return NonMemberType::all();
    }

    public function getAllChapters()
    {
        return PCRChapter::all();
    }

    public function getSpecialtyDivisionMemberships() {
        $specialty_divisions = SpecialtyDivisionMembership::all();

        if($specialty_divisions->isNotEmpty()) {
            return response()->json($specialty_divisions);
        } else {
            return response()->json(['message' => 'No specialty division memberships were found.'], 404);
        }        
    }

    public function getAffiliateSocietyMemberships() {
        $affiliate_societies = AffiliateSocietyMemberships::all();

        if($affiliate_societies->isNotEmpty()) {
            return response()->json($affiliate_societies);
        } else {
            return response()->json(['message' => 'No affiliate society memberships were found.'], 404);
        }   
    }
}