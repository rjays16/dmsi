<?php

namespace App\Http\Controllers;

use App\Models\MiniSession;
use App\Models\SessionMaterial;
use App\Models\SessionAttendee;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MiniSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRooms()
    {
        $data = MiniSession::all();
        $array_sessions = array();
        foreach ($data as $session) {
            $sponsor = Sponsor::find($session->sponsor_id);
            $session["sponsor"] = $sponsor;
            array_push($array_sessions, $session);
        }
        return response()->json($array_sessions, 200);
    }

    public function getAllRoomsByDate(Request $request)
    {
        $date = $request->date;
        $data = MiniSession::where(function($query) use ($date) {
            $query->where('start_time', 'like', "%$date%");
        })->get();
        $array_sessions = array();
        foreach ($data as $session) {
            $sponsor = Sponsor::find($session->sponsor_id);
            $session["sponsor"] = $sponsor;
            array_push($array_sessions, $session);
        }
        return response()->json($array_sessions, 200);
    }

    public function getAllRoomsBySponsor($id)
    {
        $data = MiniSession::where('sponsor_id', $id)->get();
        $array_sessions = array();
        foreach ($data as $session) {
            $sponsor = Sponsor::find($session->sponsor_id);
            $session["sponsor"] = $sponsor;
            array_push($array_sessions, $session);
        }
        return response()->json($array_sessions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRoom(Request $request) {
        $validator = Validator::make($request->all(), [
            'zoom_email' => 'required',
            'zoom_key' => 'required',
            'zoom_secret' => 'required',
        ]);
        $messages = [
            'required' => 'The :zoom_email :zoom_key :zoom_secret field is required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }
        $room = MiniSession::create($request->all());
        return response()->json([
            'status_code' => 201,
            'room' => $room
        ], 201);
    }

    public function updateRoom(Request $request, $id) {
        $room = Minisession::find($id);
        $room->update($request->all());
        //Get the current time in Unix.
        $currentTime = time();
        //The amount of hours that you want to add.
        $hoursToAdd = 2;
        //Convert the hours into seconds.
        $secondsToAdd = $hoursToAdd * (60 * 60);
        //Add the seconds onto the current Unix timestamp.
        $newTime = $currentTime + $secondsToAdd;
        $request['schedule_for'] = $room->zoom_email;
        $payload = array(
            "iss" => $room['zoom_key'],
            "exp" => $newTime
        );
        $jwt = JWT::encode($payload, $room['zoom_secret']);
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
          CURLOPT_POSTFIELDS => json_encode($request->all()),
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
                    $room->update([
                        'start_time' => $request->start_time,
                        'end_time' => $request->duration,
                        'topic' =>  $request->topic,
                        'description' => $request->description,
                        'join_url' => $data_response->join_url,
                        'start_url' => $data_response->start_url,
                    ]);
                    curl_close($curl);    
                    return response()->json([
                        'status_code' => 202,
                        'room' => $room
                    ], 201);
                    // return response()->json(json_decode($response), 201);
                default:
                    curl_close($curl);    
                    return response()->json([
                        'status_code' => $http_code,
                        'zoom_response' => curl_error($curl),
                        'zoom_data' => $response,
                        'zoom_token' => $jwt,
                        'data' => $request->all()
                    ], 400);
            }
        }
        return response()->json([
            'status_code' => 202,
            'room' => $room
        ], 201);
    }

    public function ScheduleSession(Request $request, $id) {
        //Get the current time in Unix.
        $currentTime = time();
        //The amount of hours that you want to add.
        $hoursToAdd = 2;
        //Convert the hours into seconds.
        $secondsToAdd = $hoursToAdd * (60 * 60);
        //Add the seconds onto the current Unix timestamp.
        $newTime = $currentTime + $secondsToAdd;
        $room = Minisession::find($id);
        $request['schedule_for'] = $room->zoom_email;
        $payload = array(
            "iss" => $room['zoom_key'],
            "exp" => $newTime
        );
        $jwt = JWT::encode($payload, $room['zoom_secret']);
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
          CURLOPT_POSTFIELDS => json_encode($request->all()),
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
                    $room->update([
                        'start_time' => $request->start_time,
                        'end_time' => $request->duration,
                        'topic' =>  $request->topic,
                        'description' => $request->description,
                        'join_url' => $data_response->join_url,
                        'start_url' => $data_response->start_url,
                    ]);
                    return response()->json([
                        'status_code' => 202,
                        'room' => $room
                    ], 201);
                    // return response()->json(json_decode($response), 201);
                default:
                    return response()->json([
                        'status_code' => $http_code,
                        'zoom_response' => curl_error($curl),
                        'zoom_data' => $response,
                        'zoom_token' => $jwt,
                        'data' => $request->all()
                    ], 400);
            }
        }
        curl_close($curl);
    }

    public function onePageCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zoom_email' => 'required',
            'zoom_key' => 'required',
            'zoom_secret' => 'required',
        ]);
        $messages = [
            'required' => 'The :zoom_email :zoom_key :zoom_secret field is required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }
        $room_name = $request->room_name;
        $datetime = $request->start_time;
        $zoom_email = $request->zoom_email;
        $session_exists = MiniSession::where(function($query) use ($room_name, $datetime, $zoom_email) {
            $query->where('start_time', 'like', "%$datetime%")->where('zoom_email', $zoom_email);
        })->exists();
        if ($session_exists) {
            return response()->json([
                'status_code' => 400,
                'zoom_response' => 'You cannot book another session on the same day with the same account and zoom email.'
            ], 400);
        }
        else {
            $save_room = MiniSession::create($request->all());
            //Get the current time in Unix.
            $currentTime = time();
            //The amount of hours that you want to add.
            $hoursToAdd = 2;
            //Convert the hours into seconds.
            $secondsToAdd = $hoursToAdd * (60 * 60);
            //Add the seconds onto the current Unix timestamp.
            $newTime = $currentTime + $secondsToAdd;
            $room = Minisession::find($save_room->id);
            $request['schedule_for'] = $room->zoom_email;
            $payload = array(
                "iss" => $room['zoom_key'],
                "exp" => $newTime
            );
            $jwt = JWT::encode($payload, $room['zoom_secret']);
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
              CURLOPT_POSTFIELDS => json_encode($request->all()),
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
                        $room->update([
                            'start_time' => $request->start_time,
                            'end_time' => $request->duration,
                            'topic' =>  $request->topic,
                            'description' => $request->description,
                            'join_url' => $data_response->join_url,
                            'start_url' => $data_response->start_url,
                            'room_name' => $request->room_name,
                        ]);
                        curl_close($curl);    
                        return response()->json([
                            'status_code' => 202,
                            'room' => $room
                        ], 201);
                        // return response()->json(json_decode($response), 201);
                    default:
                        curl_close($curl);    
                        return response()->json([
                            'status_code' => $http_code,
                            'zoom_data' => $response,
                            'zoom_token' => $jwt,
                            'data' => $request->all()
                        ], 400);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MiniSession  $miniSession
     * @return \Illuminate\Http\Response
     */
    public function showRoom($id)
    {
        $data = MiniSession::find($id);
        $sponsor_id = $data->sponsor_id;
        $sponsor = Sponsor::find($sponsor_id);
        $data["sponsor"] = $sponsor;
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiniSession  $miniSession
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = MiniSession::find($id);
        $data->delete();
        return response()->json([], 204);
    }

    public function uploadMaterial(Request $request, $id)
    {
        if ($file = $request->file('file_path')) {
            $path = $file->store('public/sessions');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $material = SessionMaterial::create([
                'session_id' => $id,
                'file_path' => $path,
                'file_name' => $request->file_name
            ]);

            return response()->json($material, 201);
        }
        else {
            return response()->json(['message' => 'check your inputs'], 400);
        }
    }

    public function getSessionMaterials($id) {
        try {
            $materials = SessionMaterial::where('session_id', $id)->get();
            return response()->json($materials, 200);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
        
    }

    public function deleteMaterial($id) {
        try {
            $material = SessionMaterial::find($id);
            $file = $material->file_path;
            Storage::delete($file);
            $material->delete();
            return response()->json([
                'message' => 'Delete Success'
            ], 202);

        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function registerAttendee(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'reg_id' => 'required'
        ]);
        $messages = [
            'required' => 'The :zoom_email :zoom_key :zoom_secret field is required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }
        $material = SessionAttendee::create([
            'session_id' => $request->session_id,
            'reg_id' => $request->reg_id
        ]);

        return response()->json($material, 201);
    }

    public function getSessionAttendee($id) {
        $attendees = SessionAttendee::where('session_id', $id)->get();
        return response()->json($attendees, 200);
    }
}
