<?php

namespace App\Http\Controllers;

use App\Models\PlenaryVideo;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PlenaryVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $all = PlenaryVideo::all();
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
        $plenary = PlenaryVideo::create($request->all());
        return response()->json([
            'status_code' => 201,
            'data' => $plenary
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlenaryVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function getPlenary($id)
    {
        $plenary = PlenaryVideo::find($id);
        if ($plenary == null) {
            return response()->json([
                'status_code' => 400,
                'message' => 'none exists in database'
            ], 400);    
        }
        else {
            return response()->json([
                'status_code' => 200,
                'data' => $plenary
            ], 200);   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlenaryVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plenary = PlenaryVideo::find($id);
        $plenary->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlenaryVideo  $plenaryVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plenary = PlenaryVideo::find($id);
        $plenary->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
