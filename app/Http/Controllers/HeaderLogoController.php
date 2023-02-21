<?php

namespace App\Http\Controllers;

use App\Models\HeaderLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderLogoController extends Controller
{
    public function getAll()
    {
        $all = HeaderLogo::all();
        return response()->json([
            'status_code' => 200,
            'data' => $all
        ], 200);
    }


    public function store(Request $request)
    {
        if ($file = $request->file('header_logo_img')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $lobby = HeaderLogo::create([
                'header_logo_img' => $path,
                'header_company_name' => $request->input('header_company_name')
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

    public function changeLogo(Request $request){
        $logo = HeaderLogo::find($request->id);
        if(!empty($logo)){
            $file = $request->file('header_logo_img');
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $logo->update([
                'header_logo_img' => $path
            ]);
            return response()->json([
                'message' => 'Upload Success'
            ], 202);
        }
        else{
            return response()->json(["message" => "row not found"], 404);
        }
    }


    public function getLogo($id)
    {
        $lobby = HeaderLogo::find($id);
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
        $lobby = HeaderLogo::find($id);
        $lobby->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }


    public function destroy($id)
    {
        $lobby = HeaderLogo::find($id);
        $lobby->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
