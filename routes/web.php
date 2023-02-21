<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherCodesController;
use App\Http\Controllers\PCRMemberController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\IdeapayController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\ElectionController;

if (App::environment('production')) {
    URL::forceScheme('https');
}
Route::middleware(['cors'])->group(function () { 

    Auth::routes(['verify' => true, 'reset' => false]);

    Route::get('/', function () {
        return view('home');
    });
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');
    
    Route::get('/forgot-password', function () {
        return view('auth.passwords.forgot');
    })->middleware('guest')->name('password.request');
    
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');
    
    Route::get('/reset-password/{token}', function (Request $request, $token) {
        // return view('auth.passwords.reset', ['token' => $token]);
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email, 'role' => $request->role]);
    })->middleware('guest')->name('password.reset');
    
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $redirection_link = '/login';
        if($request->role == 'sponsor'){
            $redirection_link = config('app.conv_url') . 'sponsors';
        }elseif($request->role == 'pcr'){
            $redirection_link = '/login';
        }elseif($request->role == 'pcr/attendee'){
            $redirection_link = '/login';
        }elseif($request->role == 'attendee'){
            $redirection_link = config('app.conv_url') . 'login';
        }else{
            $redirection_link = '/login';
        }
    
    
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
    
                $user->setRememberToken(Str::random(60));
    
                event(new PasswordReset($user));
            }
        );
    
        // return $status == Password::PASSWORD_RESET
        //             ? redirect()->route('login')->with('status', __($status))
        //             : back()->withErrors(['email' => [__($status)]]);
    
        return $status == Password::PASSWORD_RESET
                    ? redirect($redirection_link)
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');
    
    
    Route::get('/apply', function() {
        return view('auth.register');
    });
    Route::get('/thank-you', function() {
        return view('welcome');
    });
    Route::get('/pcr/member/{id}', [PCRMemberController::class, 'getMember']);
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/login', [AdminController::class, 'index']);
    
    
    Route::get('/admin/vouchercodes', [VoucherCodesController::class, 'index']);
    Route::get('/admin/vouchercodes/get', [VoucherCodesController::class, 'getAll']);
    Route::post('/admin/vouchercodes/create', [VoucherCodesController::class, 'create']);
    Route::post('/admin/vouchercodes/update', [VoucherCodesController::class, 'update']);
    Route::delete('/admin/vouchercodes/{id}/delete', [VoucherCodesController::class, 'delete']);
    
    Route::get('/admin/members', function() {
        return redirect('/admin/members/pending');
    });
    
    Route::get('/admin/members/{page}', [PCRMemberController::class, 'index']);
    
    Route::get('/api/pcr/member/{id}', [PCRMemberController::class, 'getMember']);
    Route::get('/api/member/decline/{id}', [PCRMemberController::class, 'declineMember']);
    
    Route::get('/admin/registration/pending/get', [RegistrationController::class, 'getAllPending']);
    Route::put('/admin/registration/pending/{id}/approve', [RegistrationController::class, 'approveRegistration']);
    
    Route::get('/admin/registration/approved/get', [RegistrationController::class, 'getAllApproved']);
    Route::get('/admin/registration/{page}', [RegistrationController::class, 'index']);
    
    Route::get('admin/election/export/{id}', [ElectionController::class, 'export']);
    
    // Route::post('/api/sponsors/create', [SponsorController::class, 'register']);
    // Route::put('/api/sponsors/update/{id}', [SponsorController::class, 'updateInfo']);
    // Route::get('/api/sponsors/all', [SponsorController::class, 'getAllSponsors']);
    
    // Route::get('/api/sponsors/pendingbooth', [SponsorController::class, 'getAllPendingSponsorBooth']);
    // Route::get('/api/sponsors/samplebooth/{id}', [SponsorController::class, 'viewSampleBooth']);
    
    // Route::get('/api/sponsors/approvebooth/{id}', [SponsorController::class, 'approveBooth']);
    // Route::get('/api/sponsors/declinebooth/{id}', [SponsorController::class, 'declineSampleBooth']);
    
    Route::get('/admin/election/active', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/election/history/{id}', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/election/add-nominees', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/announcements', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/announcements/add', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/announcements/edit', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions-start', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions/add', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions/update', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions/rooms', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions/rooms/add', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/mini-sessions/rooms/update', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/slider', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/slider/add', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/slider/edit', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/home/related-events', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/home/related-events/edit', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/home/main-banner', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/site/header', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/site/footer', function () {
        return view('admin.dashboard');
    });
    
    
    Route::get('/admin/lobby/lobby-settings', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/plenary/plenary-settings', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/sponsors/add', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/sponsors/edit', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/sponsors/booth', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors/booth/preview/platinum', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors/booth/preview/gold', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors/booth/preview/silver', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors/booth/preview/bronze', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/sponsors/booth/preview/supporter', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/contest/poster-research', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/contest/oral-research', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/admin/contest/photography', function () {
        return view('admin.dashboard');
    });
    
    
    
    // Route::get('/login', function() {
    //     return view('auth.login');
    // });
    Route::get('/blog', function () {
        return view('home');
    });
    Route::get('/announcement', function () {
        return view('home');
    });
    Route::get('/announcement/post', function () {
        return view('home');
    });
    Route::get('/login', function () {
        return view('home');
    });
    // Route::get('/registration', function () {
    //     return view('home');
    // });
    Route::get('/profile', function () {
        return view('home');
    });
    
    Route::get('/privacy-policy', function () {
        return view('home');
    });
    Route::get('/terms-and-conditions', function () {
        return view('home');
    });
    
    Route::get('/mini-sessions', function () {
        return view('home');
    });
    Route::get('/mini-sessions-details', function () {
        return view('home');
    });
    
    Route::get('/apply/thank-you', function () {
        return view('home');
    });
    Route::get('/election/thank-you', function () {
        return view('home');
    });
    
    // Route::get('/admin/import', function() {
    //     return view('admin.import');
    // });
    
    Route::get('/election', function () {
        return view('home');
    });
    // Route::post('/admin/import', function() {
    //     return view('admin.import');
    // });
    
    Route::get('/admin', function() {
        return view('home');
    });
    Route::get('/{page}', function () {
        return view('home');
    });
    
    Route::get('/welcome', function () {
        return view('welcome');
    });

    // Ideapay
    Route::group(['prefix' => 'web'], function () {   
        Route::group(['prefix' => 'payment'], function () {       
            Route::get('', [IdeapayController::class, 'verifyOrderStatus']);
            Route::post('', [IdeapayController::class, 'verifyOrderStatus']);
        });
    });
});


