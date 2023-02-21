<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Attendees;
use App\Models\Room;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    public function getAll()
    {
        $all = Session::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }

    public function getAllAttendees($id) {
        $session = Session::find($id);
        $attendees = Attendees::with('user')->where('session_id', $session['id'])->join('pcr_members', 'pcr_members.email', '=', 'attendees.email')->select('attendees.*', 'pcr_members.is_approved')->latest()->paginate(10);
        return response()->json([
            'status_code' => 200,
            'data' => $attendees
        ], 200);
    }

    public function getAllAttendeesNoPagination($id) {
        $session = Session::find($id);
        $attendees = Attendees::where('session_id', $session['id'])->latest()->get();
        $count = $attendees->count();
        return response()->json([
            'status_code' => 200,
            'total' => $count,
            'data' => $attendees
        ], 200);
    }

    public function search($id, $key) {
        $attendees = Attendees::with('user')->where('session_id', $id)
                    ->where('attendees.email', 'like', "%{$key}%")
                    ->orWhere('attendees.last_name', 'like', "%{$key}%")
                    ->orWhere('attendees.first_name', 'like', "%{$key}%")
                    ->join('pcr_members', 'pcr_members.email', '=', 'attendees.email')->select('attendees.*', 'pcr_members.is_approved')->latest()
                    ->get();
        return response()->json([
            'status_code' => 200,
            'data' => $attendees
        ], 200);
    }

    public function createSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'topic' => 'required'
        ]);
        $messages = [
            'required' => 'The :zoom_email :zoom_key :zoom_secret :room_id field is required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }
        $zoomCreds = Room::find($request->room_id);

        $topic = $request->topic;
        $datetime = $request->start_time;
        $zoom_email = $zoomCreds->zoom_email;
        $session_exists = Session::where(function($query) use ($topic, $datetime) {
            $query->where('start_time', 'like', "%$datetime%")->where('topic', $topic);
        })->exists();
        if ($session_exists) {
            return response()->json([
                'status_code' => 400,
                'zoom_response' => 'You cannot book another session on the same day with the same account and zoom email.'
            ], 400);
        }
        else {
            $save_room = Session::create([
                'topic' => $request->topic,
                'event_name' => $request->event_name,
                'start_time' => $request->start_time,
                'duration_hours' => $request->duration,
                'scheduled_date' => $request->scheduled_date,
                'description' => $request->description,
                'max_user' => $request->max_user,
                'room_id' => $request->room_id
            ]);
            //Get the current time in Unix.
            $currentTime = time();
            //The amount of hours that you want to add.
            $hoursToAdd = 2;
            //Convert the hours into seconds.
            $secondsToAdd = $hoursToAdd * (60 * 60);
            //Add the seconds onto the current Unix timestamp.
            $newTime = $currentTime + $secondsToAdd;
            $session = Session::find($save_room->id);
            $request['schedule_for'] = $zoomCreds->zoom_email;
            $payload = array(
                "iss" => $zoomCreds['zoom_key'],
                "exp" => $newTime
            );
            $jwt = JWT::encode($payload, $zoomCreds['zoom_secret']);
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.zoom.us/v2/users/me/meetings',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode([
                  'topic' => $request->topic,
                  'type' => $request->type,
                  'start_time' => $request->start_time,
                  'duration' => $request->duration,
                  'timezone' => $request->timezone,
                  'password' => $request->password,
                  'settings' => $request->settings,
              ]),
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $jwt,
                'Content-Type: application/json'
              ),
            ));
            
            $response = curl_exec($curl);
            $data_response = json_decode($response);
            // handle curl error
            if (!curl_errno($curl)) {
                switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                    case 201:  # OK
                        $session->update([
                            'join_url' => $data_response->join_url,
                            'start_url' => $data_response->start_url
                        ]);
                        curl_close($curl);    
                        return response()->json([
                            'status_code' => 201,
                            'session' => $session
                        ], 201);
                        // return response()->json(json_decode($response), 201);
                    default:
                        curl_close($curl);   
                        $session->delete(); 
                        return response()->json([
                            'status_code' => $http_code,
                            'zoom_data' => $response,
                            'zoom_token' => $jwt,
                        ], 400);
                }
            }
        }
    }

    public function getSession($id)
    {
        $room = Session::find($id);
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

    public function getSessionsByUser($id)
    {
        $room = Attendees::where('user_id', $id)->get();
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

    public function update(Request $request, $id)
    {
        $room = Session::find($id);
        $room->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }


    public function destroy($id)
    {
        $room = Session::find($id);
        $room->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
