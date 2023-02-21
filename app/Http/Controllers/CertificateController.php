<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\PCRMember;

use Exception;
use DB;

class CertificateController extends Controller
{
    public function request(Request $request) {
        $user = Auth::user();
        $pcr_member = PCRMember::where('id', $user->userable_id)->first();
        if(!is_null($pcr_member)) {
            DB::beginTransaction();
            try {
                if(!$pcr_member->has_requested_cogs) {
                    $pcr_member->has_requested_cogs = true;
                    $pcr_member->save();

                    Mail::send('mails.member.requestforcertificate', ['pcr_member' => $pcr_member], function ($message) use ($pcr_member) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                            ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                        $message->to(config('mail.from.address'));
                        $message->subject('Request for Certificate of Good Standing');
                    });
                    
                    DB::commit();
                    return response()->json(['message' => 'Successfully sent request for the Certificate of Good Standing.']);
                } else {
                    return response()->json(['message' => 'You have already sent a previous request for the Certificate of Good Standing.'], 404);
                }
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['message' => 'Member not found.'], 404);
        }
    }
}