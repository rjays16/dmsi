<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function getAll()
    {
        $all = Tag::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }


    public function store(Request $request)
    {
        $tag = Tag::create($request->all());
        return response()->json([
            'status_code' => 201,
            'data' => $tag
        ], 201);
    }


    public function getRoom($id)
    {
        $tag = Tag::find($id);
        if ($tag == null) {
            return response()->json([
                'status_code' => 400,
                'message' => 'none exists in database'
            ], 400);    
        }
        else {
            return response()->json([
                'status_code' => 200,
                'data' => $tag
            ], 200);   
        }
    }


    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
