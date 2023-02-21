<?php

namespace App\Services;

use App\Models\PCRMember;
use App\Models\Payment;
use App\Mail\InvoiceMail;
use App\Enums\PaymentMethodEnum;

use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use Exception;
use DB;

class PaymentService {
    private $ideapay_payment;

    public function __construct($ideapay_payment)
    {
        $this->ideapay_payment = $ideapay_payment;
        $this->create();
    }

    public function create() {
        DB::beginTransaction();
        try {
            $ideapay_payment = $this->ideapay_payment;
            $pcr_member = $ideapay_payment->transaction->order->pcr_member;

            $payment = new Payment();
            $payment->pcr_member_id = $pcr_member->id;
            $payment->payment_method = PaymentMethodEnum::IDEAPAY;
            $payment->order_id = $ideapay_payment->transaction->order->id;
            $payment->amount = $ideapay_payment->transaction->order->amount;
            $payment->date_paid = Carbon::now();
            $payment->save();

            // Update pcr member balance
            $pcr_member = $payment->pcr_member;
            $pcr_member->balance = $pcr_member->balance - $payment->amount;
            $pcr_member->save();

            $invoice_data = [
                'pcr_member' => $pcr_member,
                'payment' => $payment,
            ];

            Mail::send('mails.invoicemail', $invoice_data, function ($message) use ($pcr_member) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'))
                    ->cc(config('mail.reply_to.address'));
                $message->to($pcr_member->email);
                $message->subject('Payment Receipt');
            });

            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

}