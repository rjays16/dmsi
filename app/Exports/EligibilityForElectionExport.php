<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\PCRMember;
use App\Models\CollectionFee;
use DB;

class EligibilityForElectionExport implements WithHeadings, FromCollection
{
    use Exportable;

    public function __construct() {
    }

    public function headings(): array {
        $headers = [
            'Last Name',
            'First Name',
            'Email',
            'Eligibility'
        ];

        return $headers;
    }

    public function collection() {
        $membership_fee = CollectionFee::where('description', 'Membership Fee')->first();

        $query = PCRMember::leftJoin('orders', 'orders.pcr_member_id', '=', 'pcr_members.id')
            ->select(
                'pcr_members.last_name',
                'pcr_members.first_name',
                'pcr_members.email',
                DB::raw('IF(orders.status = 2, "Can vote", "Can not vote") AS "eligibility"'),
            )
            ->where('orders.collection_type_id', $membership_fee->id)
            ->orderBy('pcr_members.last_name', 'asc')
            ->get()
            ->makeHidden(['membership_type_name', 'has_pending_orders', 'can_generate_cert', 'spec_div_mem_name', 'affi_soc_mem_name', 'orders', 'payments']);

        return $query;
    }
}