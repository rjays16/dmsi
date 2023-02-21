<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConventionMail;
use App\Mail\ThankYouMail;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:registrations',
            'password' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'reg_type_id' => 'required'
        ]);
        $messages = [
            'required' => 'The :email :password field is required.',
            'unique' => 'The :email needs to be unique'
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }
        //Creating na part of the equation
        $registration = Registration::create($request->all());
        $reg = Registration::find($registration->id);
        if ($file = $request->file('profile_pic')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $user = $reg->user()->create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'profile_pic' => $path,
                'role' => 'attendee'
            ]);
        }
        else {
            $user = $reg->user()->create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'attendee'
            ]);
        }
        Mail::to($request->input('email'))->send(new ThankYouMail($reg));
        return response()->json([
            'status_code' => 201,
            'user' => $registration
        ], 201); 
    }

    public function uploadPrcId(Request $request, $id) {
        $reg = Registration::find($id);
        if ($file = $request->file('prc_upload')) {
            $path = $file->store('public/prc_files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $reg->prc_upload = $path;
            $reg->save();
            
            return response()->json([
                'message' => 'Upload Success'
            ], 201);
        }
    }

    public function getAllPending()
    {
        $data = Registration::where('is_declined', 0)
                            ->where('is_approved', 0)
                            ->orderBy('last_name', 'asc')
                            ->latest()
                            ->paginate(20);

        return response()->json($data);
    }

    public function getAllApproved()
    {
        $model = new Registration;
        $data = $model->getAllApproved();

        return response()->json($data);
    }
    
    public function getConventionProfile($id) {
        $application = Registration::find($id);
        return response()->json($application, 200);
    }

    public function searchRegisteration(Request $request) {
        try {
            $keyword = $request->keyword;
            $regs = Registration::where(function($query) use ($keyword) {
                $query->where('first_name', 'like', "%$keyword%")
                ->orWhere('last_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
            })->get();
    
            return response()->json($regs);
        }
        catch (exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function approveRegistration(Request $request)
    {
        $data = Registration::find($request->id);
        if($data) {
            $data->is_approved = 1;
            $data->save();
            //email verification
            Mail::to($data->email)->send(new ConventionMail($data));
            return response()->json($data);
        }
        return response()->json(['error' => 'Member not found.'], 400);
    }
    
    public function declineRegistration($id)
    {
        $data = Registration::find($id);
        if($data) {
            $data->is_declined = 1;
            $data->save();
            //email verification
            // Mail::to($data->email)->send(new PCRMail($data));
            return response()->json($data);
        }
        return response()->json(['error' => 'Member not found.'], 400);
    }
}
