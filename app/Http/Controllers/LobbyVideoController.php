<?php

namespace App\Http\Controllers;

use App\Models\LobbyVideo;
use Illuminate\Http\Request;

class LobbyVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $all = LobbyVideo::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lobby = LobbyVideo::create($request->all());
        return response()->json([
            'status_code' => 201,
            'data' => $lobby
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LobbyVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function getLobby($id)
    {
        $lobby = LobbyVideo::find($id);
        if ($lobby == null) {
            return response()->json([
                'status_code' => 400,
                'message' => 'none exists in database'
            ], 400);    
        }
        else {
            return response()->json([
                'status_code' => 200,
                'data' => $lobby
            ], 200);   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LobbyVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lobby = LobbyVideo::find($id);
        $lobby->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LobbyVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lobby = LobbyVideo::find($id);
        $lobby->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
