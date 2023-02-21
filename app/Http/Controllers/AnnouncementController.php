<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ThankYouMail;

class AnnouncementController extends Controller
{
    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body_text' => 'required',
                'category' => 'required'
            ]);
            $messages = [
                'required' => 'The field is required.',
                'unique' => 'The :contact_email is already on registered.'
            ];
            if ($validator->fails()) {
                // return redirect('post/create')->withErrors($validator)->withInput();
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 400);
            }
            $save = Announcement::create($request->all());
            $announcement = Announcement::find($save->id);
            if ($file = $request->file('file_path')) {
                $path = $file->store('public/announcement');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);

                $announcement->update([
                    'file_path' => $path,
                ]);

            }
            return response()->json($announcement, 201);            
        }
        catch (Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e
            ], 201);
        }
    }

    public function updateAnnoucement(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body_text' => 'required',
                'category' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 403);
            }

            $ann = Announcement::find($id);
            $ann->update($request->all());
            return response()->json($ann, 202);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function updateAnnouncementFile(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'file_path' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 403);
            }

            $ann = Announcement::find($id);
            // $ann->title = $request->input('title');
            // $ann->body_text = $request->input('body_text');
            // $ann->category = $request->input('category');
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

    public function deleteAnnoucement($id) {
        try {
            $ann = Announcement::find($id);
            $ann->delete();
            return response()->json([], 204);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getAnnouncements() {
        $data = Announcement::all();
        return response()->json($data);
    }

    public function getAnnouncementById($id) {
        try {
            $datos = Announcement::where('id', $id);
            if ($datos->exists()) {
                $data = Announcement::find($id);
                return response()->json($data);
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
