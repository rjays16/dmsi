<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConventionMail;
use App\Mail\ThankYouMail;
use App\Jobs\StoreGroupEmailToAttendeesJob;

class AttendeesController extends Controller
{
    
    public function index()
    {
        $all_users = User::where('role', 'attendee')->latest()->paginate(10);
        return response()->json([
            'status_code' => 200,
            'data' => $all_users
        ], 200);
    }

    public function search($i) {
        $all_users = User::where('email', 'like', "%{$i}%")->orWhere('first_name', 'like', "%{$i}%")->orWhere('last_name', 'like', "%{$i}%")->get();
        return response()->json([
            'status_code' => 200,
            'data' => $all_users
        ], 200);
    }

    
    public function store(Request $request)
    {
        $email = $request->email;
        $session_id = $request->session_id;
        $exists = Attendees::where(function($query) use ($email, $session_id) {
            $query->where('email', $email)->where('session_id', $session_id);
        })->exists();
        
        if ($exists) {
            return response()->json([
                'status_code' => 400,
                'message' => 'user already invited to session'
            ], 400);
        } else {
            $user = User::where('email', $email)->first();
            $request['user_id'] = $user['id'];
            $request['first_name'] = $user['first_name'];
            $request['last_name'] = $user['last_name'];
            $user['string_pw'] = 'password123';

            $attendee = Attendees::create($request->all());

            Mail::to($request->input('email'))->send(new ThankYouMail($user));

            return response()->json([
                'status_code' => 201,
                'data' => $attendee
            ], 201);
        }
    }

    public function storeGroup(Request $request) {
        $tag_id = $request->tag_id;
        $session_id = $request->session_id;

        $users = User::where('tag_id', $tag_id)->get();

        foreach ($users as $user) {
            $email = $user['email'];

            $exists = Attendees::where(function($query) use ($email, $session_id) {
                $query->where('email', $email)->where('session_id', $session_id);
            })->exists();
            
            if ($exists) {
                continue;
            } else {
                $attendee = new Attendees([
                    'email' => $email,
                    'session_id' => $session_id,
                    'user_id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                ]);
                $attendee->save();
                dispatch(new StoreGroupEmailToAttendeesJob($attendee, $user))->delay(now()->addSeconds(5));
            }
        }
        return response()->json([
            'status_code' => 201,
            'message' => 'Sending. Workers are now running in the background to proccess request'
        ], 201);
    }


    public function show(Attendees $attendees)
    {
        //
    }


    public function update(Request $request, Attendees $attendees)
    {
        //
    }


    public function destroy($id)
    {
        $attendee = Attendees::find($id);
        $attendee->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
