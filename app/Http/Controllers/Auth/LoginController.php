<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\RegistrationType;
use App\Models\MembershipType;
use App\Models\NonMemberType;
use App\Models\PCRChapter;
use App\Models\PRCNumber;
use App\Models\PreviousMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'token' => $token
        ]);

        // if($user->role == 'user') {
        //     return redirect('/convention')->with([
        //         'status_code' => 200,
        //         'token' => $token
        //     ]);
        // } else if($user->role == 'something') {
        //     return redirect('/')->with([
        //         'status_code' => 200,
        //         'token' => $token
        //     ]);
        // } else {
        //     return redirect('/admin')->with([
        //         'status_code' => 200,
        //         'token' => $token
        //     ]);
        // }
    }
}
