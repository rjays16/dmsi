<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Payment;
use DB;

class PaymentExport implements WithHeadings, FromCollection
{
    use Exportable;

    public function __construct() {
    }

    public function headings(): array {
        $headers = [
            'Name',
            'Amount',
            'Order Type',
            'Payment Method',
            'Status',
            'Date Paid'
        ];

        return $headers;
    }

    public function collection() {
        $query = Payment::join('pcr_members', 'payments.pcr_member_id', '=', 'pcr_members.id')
            ->join('orders', 'payments.order_id', '=', 'orders.id')
            ->join('collection_fees', 'orders.collection_type_id', '=', 'collection_fees.id')
            ->join('order_status', 'orders.status', '=', 'order_status.id')
            ->join('payment_methods', 'payment_method', '=', 'payment_methods.id')
            ->select(
                DB::raw("CONCAT(pcr_members.last_name, ', ', pcr_members.first_name, ' ', pcr_members.middle_name) AS member_name"),
                'payments.amount', 'collection_fees.description', 'payment_methods.name AS payment_method_name',
                'order_status.name as order_status', DB::raw('DATE_FORMAT(payments.date_paid, "%M %d, %Y") as date_paid')
            )
            ->orderBy('payments.date_paid', 'desc')
            ->get();

        return $query;
    }
}