<?php

namespace App\Exports\Member;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\PCRMember;
use DB;

class Inactive implements WithHeadings, FromCollection
{
    use Exportable;

    public function __construct() {
    }

    public function headings(): array {
        $headers = [
            'PMA No.',
            'PRC No',
            'Last Name',
            'First Name',
            'Middle Name',
            'Membership Type',
            'Special Division',
            'Affiliate Society'
        ];

        return $headers;
    }

    public function collection() {
        $inactive_members = PCRMember::join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
            ->leftJoin('specialty_division_memberships', 'pcr_members.spec_div_mem_type', '=', 'specialty_division_memberships.id')
            ->leftJoin('affiliate_society_memberships', 'pcr_members.affi_soc_mem_type', '=', 'affiliate_society_memberships.id')
            ->select(
                'pcr_members.pma_number', 'pcr_members.prc_number',
                'pcr_members.last_name', 'pcr_members.first_name', 'pcr_members.middle_name',
                'membership_types.type_name as mem_type_name',
                'specialty_division_memberships.name as specialty_div_mem_name',
                'affiliate_society_memberships.name as affiliate_soc_mem_name'
            )
            ->whereHas('user')
            ->whereHas('orders')
            ->where('pcr_members.is_active', false)
            ->where('pcr_members.is_approved', true)
            ->where('pcr_members.is_declined', false)
            ->get()
            ->makeHidden(['has_pending_orders', 'can_generate_cert', 'spec_div_mem_name', 'affi_soc_mem_name', 'can_vote']);

        return $inactive_members;
    }
}