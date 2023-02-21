<?php

namespace App\Http\Controllers;

use App\Models\PCRMember;
use App\Models\PCRChapter;
use App\Models\MembershipType;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\PCRMail;
use App\Mail\ThankYouMail;
use Ideapay\samplefolder;
use Illuminate\Support\Facades\Storage;

class ChangeProfilePictureController extends Controller
{
    public function changeProfilePic(Request $request){
        $profile = User::find($request->user_id);
        if(!empty($profile)){
            $file = $request->file('profile_pic');
            $path = $file->store('public/payment');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $profile->update([
                'profile_pic' => $path
            ]);
            return response()->json([
                'message' => 'Upload Success'
            ], 200);
        }else{
            return response()->json("user cant found", 404, );
        }
    }
}
