<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\RegistrationType;
use App\Models\MembershipType;
use App\Models\NonMemberType;
use App\Models\PCRChapter;
use App\Models\PRCNumber;
use App\Models\UserLog;
use App\Models\PCRMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PCRMail;
use App\Mail\ThankYouMail;
use App\Mail\BulkMail;
// use Illuminate\Auth\RequestGuard\Logout;

class AuthController extends Controller
{
    public function bulkEmail() {  
        try {
            $users = Registration::all();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new BulkMail($user));
            }
        } catch(\Exception $e) {
            throw $e;
        }
        if(count(Mail::failures()) > 0) {
            return response()->json(array('error' => "Mail sending has failure."), 500);
        } else {
            return response()->json(array('message' => "Successfully sent."));
        }
    }

    public function getDateTime() {
        date_default_timezone_set("Asia/Singapore");
        return response()->json(['datetime' => date("Y-m-d") . "T" . date("H:i:s")], 200);
    }

    public function memberFilter(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required:unique:App\Models\User,email',
            'prc_number' => 'required',
        ]);
        $messages = [
            'required' => 'The :email :prc_number field is required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        $member = PCRMember::where('prc_number', $request->input('prc_number'))
                    ->orWhere('email', $request->input('email'))->first();
        $message = [];
        if ($member != null) {
            if ($member->is_trainee == 1) {
                $message = [
                    'type' => 2,
                    'message' => 'User exists in master list',
                    'is_trainee' => $member->is_trainee,
                    'member' => $member->id
                ];
            }
            else {
                $message = [
                    'type' => 1,
                    'message' => 'User exists in master list',
                    'is_trainee' => $member->is_trainee,
                    'member' => $member->id
                ];
            }
        }
        else {
            $message = [
                'type' => 3,
                'message' => 'User is a non member',
                'non_member' => 'true' 
            ];
        }
        Mail::to($request->input('email'))->send(new ThankYouMail($member));
        return response()->json($message, 200); 
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required:unique:App\Models\User,email',
            'password' => 'required'
        ]);
        $messages = [
            'required' => 'The :email :password field is required.',
        ];

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Either email or password is incorrect.'
            ], 400);
        }
        $user = User::where('email', $request->email)->with(['member'])->first();
        if(!is_null($user)){
            if($user->role == "pcr" || $user->role == "pcr/attendee") {
                if($user->member->is_approved == 1) {
                    $token = $user->createToken('authToken')->plainTextToken;
                    return response()->json([
                        'status_code' => 200,
                        'token' => $token,
                        'role' => $user->role
                    ]);
                }
                else{
                    return response()->json([
                        'status_code' => 403,
                        'message' => 'User is not yet approved by admin',
                        'role' => $user->role
                    ], 403);
                }
            }else{
                return response()->json([
                    'status_code' => 400,
                    'message' => 'User is not an attendee.',
                    'role' => $user->role
                ]);
            }
        }else{
            return response()->json([
                    'status_code' => 404,
                    'message' => 'User not found.',
                ]);
        }
    }

    public function adminLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required:unique:App\Models\User,email',
            'password' => 'required'
        ]);
        $messages = [
            'required' => 'The :email :password field is required.',
        ];

        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Either email or password is incorrect.'
            ], 400);
        }
        $user = User::where('email', $request->email)->first();
        if ($user->role == "admin" || "super_admin" || "admin_pcr" || "admin_convention") {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'token' => $token,
                'role' => $user->role
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'User is not an admin',
                'role' => $user->role
            ]);
        }        
    }

    public function test() {
        return auth::user();
    }

    public function logout(Request $request) {
        // Auth::guard('web')->logout();
        $user = $request->user();
        $user->tokens()->where('tokenable_id', $user->id)->delete();
        
        // auth::user()->currentAccessToken()->delete();
        // auth()->logout();
        return response()->json([
            'status_code' => 204,
            'message' => 'Token destroyed successfuly'
        ], 204);
    }

    public function logoutAdmin(Request $request) {
        // Auth::guard('web')->logout();
        $user = $request->user();
        $user->tokens()->where('tokenable_id', '1')->delete();
        // auth::user()->currentAccessToken()->delete();
        // auth()->logout();
        return response()->json([
            'status_code' => 204,
            'message' => 'Token destroyed successfuly'
        ], 204);
    }

    public function usercreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required:unique:App\Models\User,email',
            'password' => 'required'
        ]);
        $messages = [
            'required' => 'The :email :password field is required.',
        ];
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        $registration = Registration::create($request->all());
        $user = $registration->user()->create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role')
        ]);
        event(new Registered($user));
        return response()->json([
            'status_code' => 201,
            'user' => $user
        ], 201); 
    }

    public function uploadProfPic(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        if ($file = $request->file('file')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
  
            //store your file into directory and db
            $url = Storage::url($name);
            $user = User::find($id);
            $user->profile_pic = $path;
            $user->save();
               
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $url
            ]);
        }
    }

    // Rooms APIS
    public function roomsUserCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required:unique:App\Models\User,email',
            'password' => 'required'
        ]);
        $messages = [
            'required' => 'The :email :password field is required.',
        ];
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 400);
        }
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'attendee',
            'userable_type' => 'App\Models\User',
            'tag_id' => $request->tag_id,
            'userable_id' => 0
        ]);
        event(new Registered($user));
        return response()->json([
            'status_code' => 201,
            'user' => $user
        ], 201); 
    }

    public function getUser($id)
    {
        $room = User::find($id);
        if ($room == null) {
            return response()->json([
                'status_code' => 400,
                'message' => 'none exists in database'
            ], 400);    
        }
        else {
            return response()->json([
                'status_code' => 200,
                'data' => $room
            ], 200);   
        }
    }

    public function getCurrentUser() {
        $user = User::where('id', Auth::user()->id)
            ->with(['member'])
            ->first();

        if(!is_null($user)) {
            return response()->json($user);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->update(['tag_id' => $request->input('tag_id')
        ]);
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
