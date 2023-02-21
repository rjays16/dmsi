<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{

    public function getAll()
    {
        $all = Footer::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }

    
    public function store(Request $request)
    {
        if ($file = $request->file('footer_logo_img')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $lobby = Footer::create([
                'footer_logo_img' => $path,
                'footer_rights_text' => $request->input('footer_rights_text')
            ]);
            return response()->json([
                'status_code' => 201,
                'data' => $lobby
            ], 201);
        }
        else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Make sure to select photo file'
            ], 400);
        }
    }

    public function changeFooterImage(Request $request){
        $footer = Footer::find($request->id);
        if(!empty($footer)){
            $file = $request->file('footer_logo_img');
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $footer->update([
                'footer_logo_img' => $path
            ]);
            return response()->json([
                'message' => 'Upload Success'
            ], 202);
        }else{
            return response()->json(["message" => "row not found"], 404);
        }
    }

   
    public function getFooter($id)
    {
        $lobby = Footer::find($id);
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


    public function update(Request $request, $id)
    {
        $lobby = Footer::find($id);
        $lobby->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }

    
    public function destroy($id)
    {
        $lobby = Footer::find($id);
        $lobby->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
