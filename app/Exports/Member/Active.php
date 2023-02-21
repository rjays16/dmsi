<?php

namespace App\Exports\Member;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Enums\OrderTypeEnum;
use App\Enums\OrderStatusEnum;

use App\Models\PCRMember;
use DB;

class Active implements WithHeadings, FromCollection
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
        $order_types = [OrderTypeEnum::MEMBERSHIP, OrderTypeEnum::PMA, OrderTypeEnum::COMPUTERIZATION, OrderTypeEnum::GOOD_STANDING];

        $active_members = PCRMember::join('users', 'pcr_members.id', '=', 'users.userable_id')
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
            ->has('orders', '>=', count($order_types))
            ->whereHas('orders', function($order_query) use ($order_types) {
                $order_query->whereHas('payment')
                ->whereHas('collection_fee', function ($collection_query) use ($order_types) { 
                    $collection_query->whereIn('payment_type', $order_types)
                        ->active()
                        ->forCurrentFiscalYear();
                })
                ->where('status', OrderStatusEnum::COMPLETED);
            })
            ->where('pcr_members.is_active', true)
            ->where('pcr_members.is_approved', true)
            ->where('pcr_members.is_declined', false)
            ->get()
            ->makeHidden(['has_pending_orders', 'can_generate_cert', 'spec_div_mem_name', 'affi_soc_mem_name', 'can_vote']);

        return $active_members;
    }
}