<?php

namespace App\Http\Controllers;

use App\Models\Advertisment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ThankYouMail;

class AdvertismentController extends Controller
{
    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body_text' => 'required',
                'order' => 'required'
            ]);
            $messages = [
                'required' => 'The field is required.',
            ];
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 400);
            }
            $save = Advertisment::create($request->all());
            $ads = Advertisment::find($save->id);
            if ($file = $request->file('file_path')) {
                $path = $file->store('public/announcement');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);

                $ads->update([
                    'file_path' => $path,
                ]);

            }
            return response()->json($ads, 201);            
        }
        catch (Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e
            ], 201);
        }
    }

    public function updateAds(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body_text' => 'required',
                'order' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 403);
            }

            $ann = Advertisment::find($id);
            $ann->update($request->all());
            return response()->json($ann, 202);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function updateAdsFile(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'file_path' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 403);
            }

            $ann = Advertisment::find($id);
            if ($request->hasFile('file_path')) {
                Storage::delete($ann->file_path);
                $file = $request->file('file_path');
                $path = $file->store('public/announcement');
                $name = $file->getClientOriginalName();
                $ann->file_path = $path;
                $ann->save();
            }
            return response()->json($ann, 202);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function deleteAds($id) {
        try {
            $ann = Advertisment::find($id);
            $ann->delete();
            return response()->json([], 204);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getAds() {
        $data = Advertisment::all();
        return response()->json($data);
    }

    public function getAdById($id) {
        try {
            $datos = Advertisment::where('id', $id);
            if ($datos->exists()) {
                return response()->json($datos->first());
            }
            else {
                return response()->json([
                    'message' => 'no row found'
                ], 404);
            }
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ]);
        }
    }
}
