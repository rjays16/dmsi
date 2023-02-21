<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

use App\Models\PCRMember;
use App\Models\PCRChapter;
use App\Models\MembershipType;
use App\Models\Registration;
use App\Models\User;
use App\Models\EducationalBackground;
use App\Models\CollectionFee;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Transactions;
use App\Models\DepositSlip;

use App\Enums\PaymentMethodEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;

use App\Http\Requests\Member\Register;
use App\Http\Requests\PRC\UpdateDetails;

use App\Events\OrderFee;

use App\Mail\PCRMail;
use App\Mail\ThankYouMail;
use App\Services\OrderService;

use App\Exports\Member\Active as ActiveMemberExport;
use App\Exports\Member\Inactive as InactiveMemberExport;

use Maatwebsite\Excel\Facades\Excel;

Use DB;
use Exception;
Use Carbon\Carbon;

class PCRMemberController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function getAllApplicant(Request $request) {
        $applicants = PCRMember::query()
            ->join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
            ->select(
                'pcr_members.id',
                'pcr_members.pma_number', 'pcr_members.prc_number',
                'pcr_members.last_name', 'pcr_members.first_name',
                'pcr_members.email',
                'pcr_members.created_at',
                'membership_types.type_name as membership_type_name',
            )
            ->where('is_declined', 0)
            ->where('is_approved', 0)
            ->with('user')
            ->orderBy('pcr_members.last_name', 'asc');

        if($request->exists('is_search') && $request->is_search) {
            $applicants = $applicants->whereRaw('concat(pcr_members.last_name,pcr_members.first_name,pcr_members.email,pcr_members.prc_number,pcr_members.pma_number,membership_types.type_name) LIKE ?', "%$request->keyword%");
        }
    
        $applicants = $applicants->paginate(20);

        return response()->json(['data' => $applicants]);
    }

    public function getApplicant(Request $request, $id) {
        $data = PCRMember::find($id);
        return response()->json(['data' => $data]);
    }

    public function updateApplicant(Request $request, $id) {
        DB::beginTransaction();
        try {
            $pcr_member = PCRMember::find($id);
            $pcr_member->reason = $request->reason;
            $pcr_member->save();
            DB::commit();
            return response()->json($pcr_member, 202);
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        };
    }

    public function getAllForProcessing(Request $request) { //was approved
        $data = PCRMember::query()
            ->join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
            ->select(
                'pcr_members.id',
                'pcr_members.pma_number', 'pcr_members.prc_number',
                'pcr_members.last_name', 'pcr_members.first_name',
                'pcr_members.email',
                'pcr_members.created_at',
                'pcr_members.updated_at',
                'membership_types.type_name as membership_type_name',
            )
            ->where('is_declined', 0)
            ->where('is_approved', 1)
            ->where('pcr_members.deleted_at', '=', null)
            ->orderBy('pcr_members.last_name', 'asc');

        if($request->exists('is_search') && $request->is_search) {
            $data = $data->whereRaw('concat(pcr_members.last_name,pcr_members.first_name,pcr_members.email,pcr_members.prc_number,pcr_members.pma_number,membership_types.type_name) LIKE ?', "%$request->keyword%");
        }

        $data = $data->paginate(10);
        // $data->setPath(env('APP_URL').'/api/admin/members/for-processing');

        return response()->json(['data' => $data]);
    }

    public function getAllActive(Request $request) { //has orders paid
        $order_types = [OrderTypeEnum::MEMBERSHIP, OrderTypeEnum::PMA, OrderTypeEnum::COMPUTERIZATION, OrderTypeEnum::GOOD_STANDING];

        $active_members = PCRMember::query()
            ->join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
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
            ->where('pcr_members.is_declined', false);

        if($request->exists('is_search') && $request->is_search) {
            $active_members = $active_members->whereRaw('concat(pcr_members.last_name,pcr_members.first_name,pcr_members.email,pcr_members.prc_number,pcr_members.pma_number,membership_types.type_name) LIKE ?', "%$request->keyword%");
        }

        $active_members = $active_members->with('user', 'membership_type', 'specialty_division', 'affiliate_society', 'orders.collection_fee')->paginate(10);
        
        // $active_members->setPath(env('APP_URL').'/api/admin/members/active');

        return response()->json(['data' => $active_members]);
    }

    public function getAllInActive(Request $request) { //has no orders paid
        $inactive_members = PCRMember::query()
            ->join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
            ->whereHas('user')
            ->whereHas('orders')
            ->where('pcr_members.is_active', false)
            ->where('pcr_members.is_approved', true)
            ->where('pcr_members.is_declined', false)
            ->orderBy('pcr_members.created_at', 'desc');

        if($request->exists('is_search') && $request->is_search) {
            $inactive_members = $inactive_members->whereRaw('concat(pcr_members.last_name,pcr_members.first_name,pcr_members.email,pcr_members.prc_number,pcr_members.pma_number,membership_types.type_name) LIKE ?', "%$request->keyword%");
        }

        $inactive_members = $inactive_members->with('user', 'membership_type', 'specialty_division', 'affiliate_society', 'orders.collection_fee')->paginate(10);
        // $inactive_members->setPath(env('APP_URL').'/api/admin/members/inactive');

        return response()->json(['data' => $inactive_members]);
    }

    public function getAllDeclined(Request $request) { //was declined/rejected
        $declined = PCRMember::query()
            ->join('users', 'pcr_members.id', '=', 'users.userable_id')
            ->leftJoin('membership_types', 'pcr_members.mem_type_id', '=', 'membership_types.id')
            ->select(
                'pcr_members.id',
                'pcr_members.pma_number', 'pcr_members.prc_number',
                'pcr_members.last_name', 'pcr_members.first_name',
                'pcr_members.email',
                'pcr_members.reason',
                'membership_types.type_name as membership_type_name',
            )
            ->where('is_declined', true);

        if($request->exists('is_search') && $request->is_search) {
            $declined = $declined->whereRaw('concat(pcr_members.last_name,pcr_members.first_name,pcr_members.email,pcr_members.prc_number,pcr_members.pma_number,membership_types.type_name,pcr_members.reason) LIKE ?', "%$request->keyword%");
        }
            
        $declined = $declined->with('user')->orderBy('pcr_members.last_name', 'asc')->paginate(10);
        // $paginated->setPath(env('APP_URL').'/api/admin/members/declined');

        return response()->json(['data' => $declined]);
    }

    public function getAllApprovedNoPagination() {
        $data = PCRMember::where('is_approved', 1)
            ->orderBy('last_name', 'asc')
            ->latest()->get();

        return response()->json(['data' => $data, 'total'=> count($data)]);
    }

    public function updateApplicantReason(Request $request) {
        $pcr_member = PCRMember::where('id', $request->id)->first();
        // var_dump($pcr_member);
        if(!is_null($pcr_member)) {
            DB::beginTransaction();
            try {
                $pcr_member->reason = $request->reason;
                $pcr_member->save();
                DB::commit();
                
                Mail::send('mails.declinemail', ['pcr_member' => $pcr_member], function ($message) use ($pcr_member) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                    $message->to($pcr_member->email);
                    $message->subject('Disapproved');
                });
                
                return response()->json($pcr_member, 200);

            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['error' => 'Member not found.'], 400);
        }
    }

    public function approveMember(Request $request) {
        $pcr_member = PCRMember::where('id', $request->id)->first();
        if(!is_null($pcr_member)) {
            DB::beginTransaction();
            try {
                $pcr_member->is_approved = 1;
                $pcr_member->save();

                Mail::send('mails.approvedmail', ['pcr_member' => $pcr_member], function ($message) use ($pcr_member) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                    $message->to($pcr_member->email);
                    $message->subject('Approved');
                });
                
                DB::commit();

                $collection_fees = CollectionFee::getActiveForCurrentFiscalYear();
                if($collection_fees->isNotEmpty()) {
                    $order_service = new OrderService(null);
                    $order_service->addMultipleToMember($pcr_member, $collection_fees);
                }
                
                return response()->json($pcr_member);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['error' => 'Member not found.'], 400);
        }
    }

    public function declineMember(Request $request) {
        $pcr_member = PCRMember::where('id', $request->id)->first();

        if(!is_null($pcr_member)) {
            DB::beginTransaction();
            try {
                $pcr_member->is_declined = 1;
                $pcr_member->save();
                DB::commit();
                
                return response()->json($pcr_member);

            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['error' => 'Member not found.'], 400);
        }
    }

    public function declineMemberTest($id) {
        $data = PCRMember::find($id);
        if($data) {
            $data->is_declined = 1;
            $data->save();
            //email verification
            // Mail::to($data->email)->send(new PCRMail($data));
            return response()->json($data);
        }
        return response()->json(['error' => 'Member not found.'], 400);
    }

    public function store(Register $request) {
        $validated = $request->validated();
        
        $existing_user = User::where('email', $validated['email'])->first();
        if(is_null($existing_user)) {
            DB::beginTransaction();
            try {
                $pcr_member = PCRMember::create($request->all());
                $pcr_member->member_since = now()->year;
                $pcr_member->save();
                $this->uploadPrc($request, $pcr_member);
                $this->updateEducationalBackground($request, $pcr_member, "save");

                $user = $pcr_member->user()->create([
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'pcr',
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'tag_id' => 2
                ]);

                //store your file into directory and db
                if($file = $request->file('profile_pic')) {
                    $path = $file->store('public/files');
                    $name = $file->getClientOriginalName();
                    $url = Storage::url($name);
                    $user->profile_pic = $path;
                    $user->save();
                }

                //store attached deposit slipsd
                $this->uploadDepositFromRegistration($request, $pcr_member);

                Mail::send('mails.thankyoumail', ['registration' => $pcr_member], function ($message) use ($pcr_member) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'))
                        ->cc(config('mail.reply_to.address'));
                    $message->to($pcr_member->email);
                    $message->subject('Registration');
                });
                
                DB::commit();

                return response()->json([
                    'pcr' => $pcr_member,
                    'message' => 'Successfully registered user.',
                    'status_code' => 201,
                ], 201);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => "This email has already been taken."
            ], 400);
        }
    }

    public function tagForConvention($id) {
        $application = PCRMember::find($id);
        if ($application->registered_in_convention == false) {
            $application->registered_in_convention = true;
            $application->save();

            $registration = Registration::create([
                'first_name' => $application->first_name,
                'middle_name' => $application->middle_name,
                'last_name' => $application->last_name,
                'contact_number' => $application->contact_number,
                'prc_number' => $application->prc_number,
                'address' => $application->address,
                'reg_type_id' => 1,
                'memberships' => $application->memberships,
                'chapter_id' => $application->chapter_id,
                'prc_upload' => $application->prc_upload,
                'email' => $application->email
            ]);

            $user = User::where('userable_id', $application->id)->first();
            $user->role = 'pcr/attendee';
            $user->save();

            return response()->json([
                "success" => true,
                "message" => "Tagged and registered for convention",
                "registration" => $registration
            ], 201);
        }
        else {
            return response()->json([
                "message" => "PCR Member is already registered for convention",
            ], 400);
        }
    }

    public function getMember($id) {
        $application = PCRMember::where('id',$id)->with(['educational_background', 'user'])->first();
        if($application) {
            if ($application->is_trainee == 1) {
                $application["chapter_id"] = "Not Applicable";
                $application["memberships"] = "Not Applicable";
            }
            $user = User::where('email', $application->email)->first();
            if($user->userable_type == "App\Models\Registration") {
                // dd(config('app.mem_url'));
                $explode_path = explode('/', $user->profile_pic);
                unset($explode_path[0]);
                $implode_path = implode('/', $explode_path);
                $application['profile_pic'] = config('app.conv_url') ."storage/" . $implode_path;
                return response()->json($application, 200);
            }
            else {
                $explode_path = explode('/', $user->profile_pic);
                unset($explode_path[0]);
                $implode_path = implode('/', $explode_path);
                $application['profile_pic'] = url("storage/" . $implode_path);
                return response()->json($application, 200);
            }
        } else {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }

    public function getMemberViaEmail(Request $request) {
        $application = PCRMember::where('email', $request->email)
            ->with('educational_background')
            ->first();
            
        $application['conv_url'] =  config('app.conv_url');

        if ($application->is_trainee == 1) {
            $application["chapter_id"] = "Not Applicable";
            $application["memberships"] = "Not Applicable";
        }

        $user = User::where('email', $application->email)->first();
        if($user->profile_pic) {
            if ($user->userable_type == "App\Models\Registration") {
                // dd(config('app.mem_url'));
                $explode_path = explode('/', $user->profile_pic);
                unset($explode_path[0]);
                $implode_path = implode('/', $explode_path);
                $application['profile_pic'] = config('app.conv_url') ."storage/" . $implode_path;
                return response()->json($application, 200);
            }
            else {
                $explode_path = explode('/', $user->profile_pic);
                unset($explode_path[0]);
                $implode_path = implode('/', $explode_path);
                $application['profile_pic'] = url("storage/" . $implode_path);
                return response()->json($application, 200);
            }
        } else {
            $application['profile_pic'] = null;
            return response()->json($application, 200);
        }
    }

    public function searchMember(Request $request) {
        try {
            $keyword = $request->keyword;
            $members = PCRMember::where(function($query) use ($keyword, $request) {
                $query->where('first_name', 'like', "%$keyword%")
                    ->orWhere('last_name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%");
            });

            if($request->exists('status')) {
                $members = $members->where('is_active', (int) $request->status);
            }
            
            $members = $members->get();

            return response()->json($members);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function updateMember(Request $request, $id) {
        try {
            $profile = PCRMember::find($id);
            $profile->update($request->all());
            $this->updateEducationalBackground($request, $profile, "update");
            return response()->json($profile, 202);
        }
        catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function deleteMember($id) {
        $pcr_member = PCRMember::where('id', $id)
            ->with(['orders', 'orders.transaction', 'educational_background'])
            ->first();

        if(!is_null($pcr_member)) {
            DB::beginTransaction();
            try {
                if(!empty($pcr_member->orders)) {
                    $orders = $pcr_member->orders;
                    foreach($orders as $order) {
                        if(!is_null($order->transaction->deposit_slip)) {
                            $order->transaction->deposit_slip->delete();
                        }
                        $order->transaction->delete();
                        $order->transaction->ideapay->delete();
                        if(!empty($order->payments)) {
                            $payments = $order->payments;
                            foreach($payments as $payment) {
                                if(!is_null($payment->deposit_slip_class)) {
                                    $payment->deposit_slip_class->delete();
                                }
                                $payment->delete();
                            }
                        }
                        $order->delete();
                    }
                }
                if(!empty($pcr_member->user->deposit_slips)) {
                    foreach($pcr_member->user->deposit_slips as $deposit_slip) {
                        $deposit_slip->delete();
                    }
                }
                $pcr_member->educational_background()->delete();
                $pcr_member->delete();
                $pcr_member->user->delete();
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Member deleted.']);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['status' => 'fail', 'message' => 'Member not found.'], 404);
        }
    }

    public function getTotal() {
        $pcr_member = PCRMember::all();
        return response()->json($pcr_member->count());
    }

    public function getTotalActive() {
        $total_active = PCRMember::where('is_approved', true)->get()->count();
        return response()->json($total_active);
    }

    public function uploadDepositSlip(Request $request, $id) {
        DB::beginTransaction();
        try {
            $pcr_member = PCRMember::where('id', $id)->first();
            if(!is_null($pcr_member)) {
                $order_id = $request->order_id;
                $order = Order::where('id', $order_id)->first();

                if(!is_null($order)) {
                    if($order->OrderPaments < $order->collection_fee->amount){
                        $file = $request->file('deposit_slip');
                        $path = $file->store('public/payment');
                        $name = $file->getClientOriginalName();
                        $url = Storage::url($name);

                        $deposit_slip = new DepositSlip();
                        $deposit_slip->user_id = $pcr_member->user->id;
                        $deposit_slip->path = $path;
                        $deposit_slip->save();

                        $order_id = $request->order_id;

                        $order = Order::where('id', $order_id)->first();
                        $payment = new Payment();
                        $payment->pcr_member_id = $pcr_member->id;
                        $payment->payment_method = PaymentMethodEnum::BANK;
                        $payment->order_id = $order->id;
                        $payment->amount = $request->amount;
                        $payment->date_paid = Carbon::now();
                        $payment->deposit_slip_id = $deposit_slip->id;
                        $payment->save();

                        DB::commit();
                        return response()->json([
                            'message' => 'Successfully uploaded deposit slip.'
                        ], 201);
                    } else {
                        return response()->json([
                            'message' => 'This order has already been fully paid.'
                        ], 400);
                    } 
                } else {
                    return response()->json([
                        'message' => 'Order not found.'
                    ], 404);
                } 
            } else {
                return response()->json([
                    'message' => 'PCR Member not found.'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePRCDetails(UpdateDetails $request) {
        $user = Auth::user();
        $validated = $request->validated();

        if($user->role == "pcr" || $user->role == "pcr/attendee") {
            $pcr_member = $user->member;

            DB::beginTransaction();
            try {
                if($file = $request->file('prc_upload')) {
                    $path = $file->store('public/prc_files');
                    $name = $file->getClientOriginalName();
                    $url = Storage::url($name);
                    $pcr_member->prc_upload = $path;
                    $pcr_member->save();
                }

                $pcr_member->update($validated);

                $date_now = Carbon::today()->toDateString();
                if(Carbon::parse($pcr_member->prc_expiration)->gte(Carbon::parse($date_now)) && !$pcr_member->email_for_active_status_sent) {
                    $pcr_member->is_active = true;
                    $pcr_member->email_for_active_status_sent = true;
                    $pcr_member->save();
                }

                DB::commit();

                Mail::send('mails.member.newactive', ['pcr_member' => $pcr_member], function ($message) use ($pcr_member) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                    $message->to(config('mail.reply_to.address'));
                    $message->subject('Active Member');
                });

                return response()->json(['message' => 'Successfully updated details.']);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['message' => 'Invalid role.'], 400);
        }
	}

    private function uploadPrc($request, $pcr_member) {
        if ($file = $request->file('prc_upload')) {
            $path = $file->store('public/prc_files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $pcr_member->prc_upload = $path;
            $pcr_member->save();
        }
	}

    private function uploadDepositFromRegistration($request, $pcr_member) {
        if(!is_null($request)){
            foreach($request as $key => $ds){
                if($request[$key] != 'undefined'){
                    $collection_fee = CollectionFee::where('id', $key)->first();
                    if($request->hasFile('collection_list['.$key.']')) {
                        $path = $file->store('public/prc_files');
                        $name = $file->getClientOriginalName();
                        $url = Storage::url($name);
            
                        $pcr_member->prc_upload = $path;
                        $pcr_member->save();

                        $order = new Order();
                        $order->pcr_member_id = $pcr_member->user->id;
                        $order->amount = $collection_fee->amount;
                        $order->year = $collection_fee->year;
                        $order->collection_type_id = $request->collection_type_id;
                        $order->type = $collection_fee->payment_type;
                        $order->status = OrderStatusEnum::FOR_APPROVAL;
                        $order->save();

                        $deposit_slip = new DepositSlip();
                        $deposit_slip->user_id = $pcr_member->user->id;
                        $deposit_slip->path = $path;
                        $deposit_slip->save();

                        $transaction = new Transactions();
                        $transaction->amount = $order->amount;
                        $transaction->order_id = $order->id;
                        $transaction->deposit_slip_id = $deposit_slip->id;
                        $transaction->save();

                        $payment = new Payment();
                        $payment->pcr_member_id = $pcr_member->id;
                        $payment->payment_method = PaymentMethodEnum::BANK;
                        $payment->order_id = $order->id;
                        $payment->amount = $request->amount;
                        $payment->date_paid = Carbon::now();
                        $payment->deposit_slip_id = $deposit_slip->id;
                        $payment->save();

                        event(new OrderFee($order));
                    }
                }
            }
        }
	}

    private function updateEducationalBackground($request, $pcr_member, $action) {
        $data = [
            'medicine' => $request->input('medicine'),
            'med_graduation' => $request->input('med_graduation'),
            'residency' => $request->input('residency'),
            'res_graduation' => $request->input('res_graduation'),
            'specialty' => $request->input('specialty'),
            'spec_graduation' => $request->input('spec_graduation'),
            'specialty_society' => $request->input('specialty_society'),
            'specialty_society_graduation' => $request->input('specialty_society_graduation'),
            'subspecialty' => $request->input('subspecialty'),
            'subspecialty_society' => $request->input('subspecialty_society'),
            'subspecialty_society_induction' => $request->input('subspecialty_society_induction'),
            'master_education' => $request->input('master_education'),
            'master_education_school' => $request->input('master_education_school'),
        ];

        if($action === "save") {
            $pcr_member->educational_background()->save(new EducationalBackground($data));
        } elseif($action === "update") {
            $pcr_member->educational_background()->update($data);
        }
    }

    public function getInvoice(Request $request, $id) {
        $payment = Payment::find(3);
        $pcr_member = $payment->pcr_member;  
        $pcr_member = PCRMember::where('id', $request->id)->first();   

        if(!is_null($pcr_member)) {
            try {               
                $data = [
                    'pcr_member' => $pcr_member,
                    'payment' => $payment
                ];

                Mail::send('mails.invoicemail', $data , function ($message) use ($pcr_member) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                    $message->to($pcr_member->email);
                    $message->subject('Payment Receipt');
                });

                return response()->json($pcr_member->email);
                
            } catch(Exception $e) {
                throw $e;
            }
        } else {
            return response()->json(['error' => 'Member not found.'], 400);
        }

    }

    public function sendRegistrationEmail() {
        $users = DB::select('CALL sp_EmailMembers()');

        $num_sent = 0;
        if(!empty($users)) {
            foreach($users as $key => $user) {
                $html = "<p>Dear MDMS Member,<br />
                Greetings!<br /><br />
                Thank you for registering at the MDMSI Membership Portal.<br /><br />
                To complete your registration process, please post your deposit slip or receipt at the payment box or proceed to pay at the payment portal.<br /><br />
                We will send you the Zoom link for the Launching of MDMSI and the Induction of New Officers and Members of this society scheduled on September 25,2021 at 9 AM once the registration process is completed.<br />
                Thank you and good day!<br/><br/>
                MDMSI Officers</p>";
                try {
                    Mail::send([], [], function($message) use ($user, $html) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
                        $message->to($user->email);
                        $message->subject('MDMS Membership Registration')
                            ->setBody($html, 'text/html');
                    });
                    $num_sent += 1;
                } catch(Exception $e) {
                    throw new Exception("Could not send email to user: $user->email. Error: $e");
                }

                if ($key === array_key_last($users)) {
                    echo "Sent $num_sent emails to user/s.";
                }
            }
        }
    }

    public function resetPassword($id) {
        $pcr_member = PCRMember::where('id', $id)->first();

        if(!is_null($pcr_member)) {
            $user = $pcr_member->user;

            if(!is_null($user)) {
                $user->password = Hash::make("MDMS@2022");
                $user->save();

                return response()->json(['message' => "Successfully reset member's password"]);
            } else {
                return response()->json(['message' => "Member doesn't have a user account. Please contact the site admin"], 400);
            }
        } else {
            return response()->json(['message' => 'Member not found'], 400);
        }
    }

    public function exportActive() {
        return Excel::download(new ActiveMemberExport(), 'active_members.xlsx');
    }

    public function exportInactive() {
        return Excel::download(new InactiveMemberExport(), 'inactive_members.xlsx');
    }
}