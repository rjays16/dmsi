<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getAll()
    {
        $all = Room::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }


    public function store(Request $request)
    {
        $room = Room::create($request->all());
        return response()->json([
            'status_code' => 201,
            'data' => $room
        ], 201);
    }


    public function getRoom($id)
    {
        $room = Room::find($id);
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
        $room = Room::find($id);
        $room->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }


    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
