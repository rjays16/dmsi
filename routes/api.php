<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Mail\SendEmailMailable;
use App\Jobs\SendNotificationEmail;
use App\Services\IdeapayService;

use App\Http\Controllers\{
    AuthController,
    PCRMemberController,
    FieldController,
    RegistrationController,
    UsersImportController,
    SponsorController,
    AnnouncementController,
    AdvertismentController,
    ChangeProfilePictureController,
    MiniSessionController,
    RelatedEventController,
    ElectionController,
    ConventionContestController,
    PlenaryVideoController,
    LobbyVideoController,
    MainBannerController,
    FooterController,
    HeaderLogoController,
    RoomController,
    SessionController,
    AttendeesController,
    TagController,
    OrderController,
    CollectionFeesController,
    FiscalPeriodController,
    IdeapayController,
    PaymentController,
    AffiliateSocietyController,
    CertificateController,
};

Route::middleware(['cors'])->group(function () {
    if (App::environment('production')) {
        URL::forceScheme('https');
    }

    // Route::get('/active', function () {
    //     $pcr_member = App\Models\PCRMember::where('id', 772)->first();
    //     Mail::send('mails.member.newactive', ['pcr_member' => $pcr_member], function ($message) use ($pcr_member) {
    //         $message->from(config('mail.from.address'), config('mail.from.name'))
    //             ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
    //         $message->to(config('mail.reply_to.address'));
    //         $message->subject('Active Member');
    //     });
    //     // return new App\Mail\Member\NewActive($pcr_member);
    // });
    
    Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getCurrentUser']);
        
    Auth::routes(['verify' => true, 'reset' => false]);
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/login');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::resource('members', PCRMemberController::class);   
    
    Route::get('/sendRegistrationEmail', [PCRMemberController::class, 'sendRegistrationEmail']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/admin/login', [AuthController::class, 'adminLogin']);
    Route::post('/createuser', [AuthController::class, 'usercreate']);
    Route::post('/createroomuser', [AuthController::class, 'roomsUserCreate']);
    Route::get('/checkuser', [AuthController::class, 'memberFilter']);
    Route::get('/registrationtype', [FieldController::class, 'getAllRegistrationType']);
    Route::get('/membershiptype', [FieldController::class, 'getMembershipTypes']);
    Route::get('/nonMembertypes', [FieldController::class, 'getAllNonMemberType']);
    Route::get('/chaptertypes', [FieldController::class, 'getAllChapters']);
    Route::get('/specialty-divisions', [FieldController::class, 'getSpecialtyDivisionMemberships']);
    Route::get('/affiliate-societies', [FieldController::class, 'getAffiliateSocietyMemberships']);
    Route::post('/user/uploadpic/{id}', [AuthController::class, 'uploadProfPic']);
    Route::put('/pcr/member/conventiontag/{id}', [PCRMemberController::class, 'tagForConvention']);
    // Route::post('/admin/import', [UsersImportController::class, 'store']);
    // Route::post('/admin/lifetime/import', [UsersImportController::class, 'storeLifeMembers']);
    Route::delete('/auth/logout/admin', [AuthController::class, 'logoutAdmin']);
    Route::put('/registration/decline/{id}', [RegistrationController::class, 'declineRegistration']);
    Route::put('/member/decline/{id}', [PCRMemberController::class, 'declineMember']);
    Route::get('/minisession/rooms/schedule', [MiniSessionController::class, 'getAllRoomsByDate']);
    Route::get('/convention/profile/forregistration/{id}', [RegistrationController::class, 'getConventionProfile']);
    Route::get('/getdatetime', [AuthController::class, 'getDateTime']);
    Route::get('/getallmembers', [PCRMemberController::class, 'getAllApprovedNoPagination']);
    
    Route::get('/banner', [MainBannerController::class, 'getAll']);
    Route::get('/footer', [FooterController::class, 'getAll']);
    Route::get('/headerlogo', [HeaderLogoController::class, 'getAll']);
    
    Route::put('/admin/members/pending/{id}/approve', [PCRMemberController::class, 'approveMember']);
    Route::put('/ideapay/create', [IdeapayController::class, 'create']);
    
    Route::get('/election/exportMemberEligibility', [ElectionController::class, 'exportMemberEligibility']);

    Route::get('2022-fees-list-enabled-deposit-slip', [CollectionFeesController::class, 'getCollectionFees2022EnabledUploadDeposit']);
    
    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::post('/test', [AuthController::class, 'test']);
        Route::post('/bulkemail', [AuthController::class, 'bulkEmail']);
        Route::delete('/auth/logout', [AuthController::class, 'logout']);
        
        // Sponsors APIs
        Route::group(['prefix' => 'sponsors'], function() {
            Route::post('create', [SponsorController::class, 'register']);
            Route::post('draft/upload/{id}/{file_type}', [SponsorController::class, 'uploadToSample']);
            Route::put('update/{id}', [SponsorController::class, 'updateInfo']);
            Route::get('samplebooth/{id}', [SponsorController::class, 'viewSampleBooth']);
            Route::put('approvebooth/{id}', [SponsorController::class, 'approveBooth']);
            Route::put('declinebooth/{id}', [SponsorController::class, 'declineSampleBooth']);
            Route::get('pendingbooth', [SponsorController::class, 'getAllPendingSponsorBooth']);
            Route::get('all', [SponsorController::class, 'getAllSponsors']);
            Route::get('{id}', [SponsorController::class, 'getSponsorProfileBooth']);
            Route::get('resource/{id}', [SponsorController::class, 'getAllSponsorResources']);
            Route::get('product/{id}', [SponsorController::class, 'getAllSponsorProducts']);
        });

        // ADMIN APIs
        Route::group(['prefix' => 'convention'], function() {
            Route::get('profile/{id}', [RegistrationController::class, 'getConventionProfile']);
            Route::get('search', [RegistrationController::class, 'searchRegisteration']);
        });
    
        Route::group(['prefix' => 'pcr'], function() {
            Route::get('search', [PCRMemberController::class, 'searchMember']);
            Route::get('memberemail', [PCRMemberController::class, 'getMemberViaEmail']);
            Route::post('{id}/reset-password', [PCRMemberController::class, 'resetPassword']);
            Route::post('upload/deposit/{id}', [PCRMemberController::class, 'uploadDepositSlip']);
            Route::post('details', [PCRMemberController::class, 'updatePRCDetails']);                

            Route::group(['prefix' => 'member'], function() {
                Route::get('total', [PCRMemberController::class, 'getTotal']);
                Route::get('total/active', [PCRMemberController::class, 'getTotalActive']);
                Route::get('{id}', [PCRMemberController::class, 'getMember']);
                Route::put('{id}', [PCRMemberController::class, 'updateMember']);
                Route::delete('{id}', [PCRMemberController::class, 'deleteMember']);
            });

            // Announcement APIs
            Route::group(['prefix' => 'announcement'], function() {
                Route::post('', [AnnouncementController::class, 'create']);
                Route::get('all', [AnnouncementController::class, 'getAnnouncements']);
                Route::put('update/{id}', [AnnouncementController::class, 'updateAnnoucement']);
                Route::post('updatefile/{id}', [AnnouncementController::class, 'updateAnnouncementFile']);
                Route::delete('delete/{id}', [AnnouncementController::class, 'deleteAnnoucement']);
                Route::get('details/{id}', [AnnouncementController::class, 'getAnnouncementById']);
            });

            // Advertisment APIs
            Route::group(['prefix' => 'ads'], function() {
                Route::post('', [AdvertismentController::class, 'create']);
                Route::get('all', [AdvertismentController::class, 'getAds']);
                Route::put('update/{id}', [AdvertismentController::class, 'updateAds']);
                Route::post('updatefile/{id}', [AdvertismentController::class, 'updateAdsFile']);
                Route::delete('delete/{id}', [AdvertismentController::class, 'deleteAds']);
                Route::get('details/{id}', [AdvertismentController::class, 'getAdById']);
            });
        });
    
        //Mini Sessions
        Route::group(['prefix' => 'minisession'], function() {
            Route::post('create', [MiniSessionController::class, 'onePageCreate']);

            Route::group(['prefix' => 'room'], function() {
                Route::post('', [MiniSessionController::class, 'createRoom']);
                Route::put('edit/{id}', [MiniSessionController::class, 'updateRoom']);
            });

            Route::group(['prefix' => 'rooms'], function() {
                Route::get('', [MiniSessionController::class, 'getAllRooms']);
                Route::get('sponsor/{id}', [MiniSessionController::class, 'getAllRoomsBySponsor']);
            });
            
            Route::post('upload/session/{id}', [MiniSessionController::class, 'uploadMaterial']);

            Route::group(['prefix' => 'session'], function() {
                Route::post('{id}', [MiniSessionController::class, 'ScheduleSession']);
                Route::get('{id}', [MiniSessionController::class, 'showRoom']);
                Route::delete('{id}', [MiniSessionController::class, 'delete']);
            });

            Route::group(['prefix' => 'materials'], function() {
                Route::get('session/{id}', [MiniSessionController::class, 'getSessionMaterials']);
                Route::delete('{id}', [MiniSessionController::class, 'deleteMaterial']);
            });

            Route::group(['prefix' => 'attendee'], function() {
                Route::post('register', [MiniSessionController::class, 'registerAttendee']);
                Route::get('get/session/{id}', [MiniSessionController::class, 'getSessionAttendee']);
            });
        });
    
        //Related Events
        Route::group(['prefix' => 'events'], function() {
            // Route::post('create', [RelatedEventController::class, 'createRoom']);
            Route::post('sitelink/edit/{id}', [RelatedEventController::class, 'updateEvent']);
            Route::get('sitelinks', [RelatedEventController::class, 'getAllEvents']);
            // Route::post('/minisession/session/{id}', [RelatedEventController::class, 'ScheduleSession']);
        });
    
        //Election APIs
        Route::group(['prefix' => 'election'], function() {
            Route::get('members/{id}', [ElectionController::class, 'getElectionPeriodNominees']);
            Route::post('create', [ElectionController::class, 'create']);
            Route::get('search', [ElectionController::class, 'searchNominees']);
            Route::get('nominated/search', [ElectionController::class, 'searchNominated']);
            Route::get('checkActive', [ElectionController::class, 'checkActiveElection']);
            Route::get('nominees/{id}', [ElectionController::class, 'getNominees']);
            Route::get('history/{id}', [ElectionController::class, 'getElectionPeriodDetails']);
            Route::put('close/{id}', [ElectionController::class, 'close']);
            Route::get('nominee/{id}', [ElectionController::class, 'getMember']);
            Route::post('nominate', [ElectionController::class, 'nominate']);
            Route::get('checkNominee/{period}/{member}', [ElectionController::class, 'checkNominee']);
            Route::put('updateNominated/{id}', [ElectionController::class, 'updateNominated']);
            Route::delete('deleteNominee/{id}', [ElectionController::class, 'deleteNominee']);
            Route::put('selectedNominee', [ElectionController::class, 'getSelectedNominees']);
            Route::put('vote', [ElectionController::class, 'vote']);
            Route::get('checkVoteStatus/{id}/{election}', [ElectionController::class, 'checkVoteStatus']);
            Route::get('nomineeDetails/{id}', [ElectionController::class, 'getNomineeDetails']);    
            Route::get('{type}/{user}', [ElectionController::class, 'getElectionPeriod']);
        });
    
        //Photo Contest API
        Route::group(['prefix' => 'contest'], function() {
            Route::group(['prefix' => 'item'], function() {
                // Research Poster
                Route::get('getResearchPoster', [ConventionContestController::class, 'getPosterResearchEntries']);
                Route::post('create/poster', [ConventionContestController::class, 'createPosterResearch']);
                Route::delete('poster/{id}', [ConventionContestController::class, 'deletePosterResearch']);
            
                // Oral Research
                Route::get('getOralResearch', [ConventionContestController::class, 'getOralResearchEntries']);
                Route::post('create/oral', [ConventionContestController::class, 'createOralResearch']);
                Route::delete('oral/{id}', [ConventionContestController::class, 'deleteOralResearch']);
            
                // Photo Contest
                Route::get('getPhotography', [ConventionContestController::class, 'getPhotographyEntries']);
                Route::post('create/photo', [ConventionContestController::class, 'createPhotography']);
            
                Route::post('create', [ConventionContestController::class, 'store']);
                Route::post('upload/{id}/{file_type}', [ConventionContestController::class, 'uploadFiles']);      
            });  
        
            Route::post('editResearchPosterEntry', [ConventionContestController::class, 'editResearchPosterEntry']);
            Route::post('editOralResearchEntry', [ConventionContestController::class, 'editOralResearchEntry']);
            Route::post('editPhotoContestEntry', [ConventionContestController::class, 'editPhotoContestEntry']);
        
            Route::post('setRank', [ConventionContestController::class, 'setRank']);
        });
    
        /// Change Profile Picture
        Route::post('/changeProfilePic', [ChangeProfilePictureController::class, 'changeProfilePic']);
    
        // Plenary Hall Video and Chat
        Route::group(['prefix' => 'plenary'], function() {
            Route::get('', [PlenaryVideoController::class, 'getAll']);
            Route::post('', [PlenaryVideoController::class, 'store']);
            Route::get('{id}', [PlenaryVideoController::class, 'getPlenary']);
            Route::put('update/{id}', [PlenaryVideoController::class, 'update']);
            Route::delete('delete/{id}', [PlenaryVideoController::class, 'destroy']);            
        });
    
        // Lobby Video
        Route::group(['prefix' => 'lobby'], function() {
            Route::post('', [LobbyVideoController::class, 'store']);
            Route::get('{id}', [LobbyVideoController::class, 'getLobby']);
            Route::put('update/{id}', [LobbyVideoController::class, 'update']);
            Route::delete('delete/{id}', [LobbyVideoController::class, 'destroy']);
            Route::get('lobby', [LobbyVideoController::class, 'getAll']);
        });
    
        // Main Banner
        Route::group(['prefix' => 'banner'], function() {
            Route::post('', [MainBannerController::class, 'createBanner']);
            Route::get('{id}', [MainBannerController::class, 'getMainBanner']);
            Route::put('update/{id}', [MainBannerController::class, 'update']);
            Route::delete('delete/{id}', [MainBannerController::class, 'destroy']);   
            Route::post('upload', [MainBannerController::class, 'changeBanner']);
        });
    
        // Footer
        Route::group(['prefix' => 'footer'], function() {
            Route::post('', [FooterController::class, 'store']);
            Route::get('{id}', [FooterController::class, 'getFooter']);
            Route::put('update/{id}', [FooterController::class, 'update']);
            Route::delete('delete/{id}', [FooterController::class, 'destroy']);
            Route::post('footer/upload', [FooterController::class, 'changeFooterImage']);
        });
    
        // Header Logo
        Route::group(['prefix' => 'headerlogo'], function() {
            Route::post('', [HeaderLogoController::class, 'store']);
            Route::get('{id}', [HeaderLogoController::class, 'getLogo']);
            Route::put('update/{id}', [HeaderLogoController::class, 'update']);
            Route::delete('delete/{id}', [HeaderLogoController::class, 'destroy']);
            Route::post('upload', [HeaderLogoController::class, 'changeLogo']);
        });
    
        // Room APIs
        Route::group(['prefix' => 'room'], function() {
            Route::get('', [RoomController::class, 'getAll']);
            Route::post('', [RoomController::class, 'store']);
            Route::get('{id}', [RoomController::class, 'getRoom']);
            Route::put('update/{id}', [RoomController::class, 'update']);
            Route::delete('delete/{id}', [RoomController::class, 'destroy']);            
        });

        // Tag APIs
        Route::group(['prefix' => 'tags'], function() {
            Route::post('', [TagController::class, 'store']);
            Route::get('{id}', [TagController::class, 'getRoom']);
            Route::put('update/{id}', [TagController::class, 'update']);
            Route::delete('delete/{id}', [TagController::class, 'destroy']);
        });        
        Route::get('/all/tags', [TagController::class, 'getAll']);
    
        // Session APIs
        Route::group(['prefix' => 'session'], function() {
            Route::get('', [SessionController::class, 'getAll']);
            Route::post('', [SessionController::class, 'createSession']);
            Route::get('{id}', [SessionController::class, 'getSession']);
            Route::put('update/{id}', [SessionController::class, 'update']);
            Route::delete('delete/{id}', [SessionController::class, 'destroy']);            
            Route::get('attendees/{id}', [SessionController::class, 'getAllAttendees']);
            Route::get('attendees/all/{id}', [SessionController::class, 'getAllAttendeesNoPagination']);
            Route::get('attendees/search/{id}/{key}', [SessionController::class, 'search']);
            Route::post('attend', [AttendeesController::class, 'store']);
            Route::delete('attendee/{id}', [AttendeesController::class, 'destroy']);
            Route::get('user/{id}', [SessionController::class, 'getSessionsByUser']);
            Route::post('group/attend', [AttendeesController::class, 'storeGroup']);
        });    
    
        // Attendees
        Route::group(['prefix' => 'attendees'], function() {
            Route::get('{id}', [AuthController::class, 'getUser']);
            Route::get('', [AttendeesController::class, 'index']);
            Route::get('search/{i}', [AttendeesController::class, 'search']);
            Route::put('update/{id}', [AuthController::class, 'updateUser']);
            Route::delete('delete/{id}', [AuthController::class, 'destroyUser']);
        });  

        //Admin Page
        Route::group(['prefix' => 'admin'], function() {
            Route::group(['prefix' => 'members'], function() {
                Route::group(['prefix' => 'applicant'], function() {
                    Route::get('', [PCRMemberController::class, 'getAllApplicant']);
                    Route::get('{id}', [PCRMemberController::class, 'getApplicant']);
                    Route::post('{id}', [PCRMemberController::class, 'updateApplicantReason']);
                });

                Route::group(['prefix' => 'export'], function() {
                    Route::get('active', [PCRMemberController::class, 'exportActive']);
                    Route::get('inactive', [PCRMemberController::class, 'exportInactive']);
                });

                Route::get('for-processing', [PCRMemberController::class, 'getAllForProcessing']);
                Route::get('active', [PCRMemberController::class, 'getAllActive']);
                Route::get('inactive', [PCRMemberController::class, 'getAllInActive']);
                Route::get('declined', [PCRMemberController::class, 'getAllDeclined']);
                // Route::put('invoice/{id}/send', [PCRMemberController::class, 'getInvoice']);
            });
        });

        // Affiliate Society
        Route::group(['prefix' => 'affiliate-society'], function() {
            Route::group(['prefix' => '{id}'], function () {
                Route::get('members', [AffiliateSocietyController::class, 'getMembers']);
            });
        });

        // Orders
        Route::group(['prefix' => 'orders'], function () {
            Route::get('types', [OrderController::class, 'getOrderTypes']);
            Route::post('create', [OrderController::class, 'create']);
           
            Route::group(['prefix' => 'user'], function () {
                Route::post('annual-membership',  [OrderController::class, 'getUserAnnualOrders']);
                Route::post('dashboard',  [OrderController::class, 'getDashboardOrders']);
                Route::post('update',  [OrderController::class, 'updateMemberOrder']);
            });

            Route::group(['prefix' => '{id}'], function () {
                Route::get('', [OrderController::class, 'getOrder']);
            });
        });

        Route::group(['prefix' => 'fees'], function () {
            Route::group(['prefix' => 'order'], function () {
                Route::post('', [OrderController::class, 'newOrderCreate']);
                Route::post('cogs', [OrderController::class, 'updateCOGSOrderToClaimed']);
            });
        });

        // Collection Fees
        Route::group(['prefix' => 'collection-fees'], function () {
            Route::get('', [CollectionFeesController::class, 'getCollectionFees']);
            Route::post('', [CollectionFeesController::class, 'create']);
            Route::post('{id}', [CollectionFeesController::class, 'update']);
            Route::get('active', [CollectionFeesController::class, 'getActive']);
            Route::group(['prefix' => 'member'], function () {
                Route::group(['prefix' => '{id}'], function () {
                    Route::get('', [CollectionFeesController::class, 'getCollectionFeesByMember']); // For getting the fees for the member dashboard
                });
                Route::put('', [CollectionFeesController::class, 'addToMember']);
                Route::post('create', [CollectionFeesController::class, 'createForMember']);
                Route::post('all', [CollectionFeesController::class, 'addToAllActive']);
            });

            Route::group(['prefix' => '{id}'], function () {
                Route::delete('', [CollectionFeesController::class, 'delete']);
            });
        });

        // Fiscal Period
        Route::group(['prefix' => 'fiscal-period'], function() {
            Route::get('', [FiscalPeriodController::class, 'getFiscalPeriods']);
            Route::post('', [FiscalPeriodController::class, 'create']);
            Route::get('all', [FiscalPeriodController::class, 'getFiscalPeriodsNoPagination']);
            Route::get('active', [FiscalPeriodController::class, 'getActive']);
            Route::get('{id}', [FiscalPeriodController::class, 'showFiscalDetails']);
            Route::put('update/{id}', [FiscalPeriodController::class, 'update']);
            Route::delete('delete/{id}', [FiscalPeriodController::class, 'delete']);            
        });

        // Certificate
        Route::group(['prefix' => 'certificate'], function() {
            Route::post('request', [CertificateController::class, 'request']);
        });

        // Payment
        Route::group(['prefix' => 'payments'], function () {
            Route::get('search', [PaymentController::class, 'search']);
            Route::get('export', [PaymentController::class, 'export']);
            Route::get('', [PaymentController::class, 'getPaymentLedger']);
            Route::get('{user_id}', [PaymentController::class, 'getPaymentHistory']);
            Route::get('deposit-slip/{id}', [PaymentController::class, 'getDepositSlip']);

            Route::group(['prefix' => '{id}'], function () {
                Route::delete('', [PaymentController::class, 'delete']);
            });
        });

        // Ideapay
        Route::group(['prefix' => 'ideapay'], function () {  
            Route::post('verify', [IdeapayController::class, 'verifyOrderStatus']);
        });
    });
});