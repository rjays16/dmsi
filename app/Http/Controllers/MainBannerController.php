<?php

namespace App\Http\Controllers;

use App\Models\MainBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $all = MainBanner::all();
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
    public function createBanner(Request $request)
    {
        if ($file = $request->file('image_file')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);

            $lobby = MainBanner::create([
                'image_file' => $path,
                'title1' => $request->input('title1'),
                'title2' => $request->input('title2'),
                'subheading' => $request->input('subheading'),
                'cta_button_text' => $request->input('cta_button_text'),
                'cta_button_url' => $request->input('cta_button_url'),
                'text_color' => $request->input('text_color'),
                'page_type' => $request->input('page_type'),
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

    public function changeBanner(Request $request){
        $banner = MainBanner::find($request->id);
        if(!empty($banner)){
            $file = $request->file('image_file');
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $banner->update([
                'image_file' => $path
            ]);
            return response()->json([
                'message' => 'Upload Success'
            ], 202);
        }else{
            return response()->json(["message" => "row not found"], 404);
        }
    }

    public function getMainBanner($id)
    {
        $lobby = MainBanner::find($id);
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
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lobby = MainBanner::find($id);
        $lobby->update($request->all());
        return response()->json([
            'status_code' => 202,
            'message' => 'row updated'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lobby = MainBanner::find($id);
        $lobby->delete();
        return response()->json([
            'status_code' => 204,
            'message' => 'row deleted'
        ], 204);
    }
}
