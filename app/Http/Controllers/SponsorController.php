<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\SponsorSample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ThankYouMail;

//Added by abing
use App\Models\SponsorProducts;
use App\Models\SponsorResources;

class SponsorController extends Controller
{
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'contact_email' => 'required|unique:sponsors',
                'password' => 'required',
                'name' => 'required',
                'description' => 'required',
                'address' => 'required',
                'contact_number' => 'required',
                'type_id' => 'required'
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
            //Creating na part of the equation
            $save = Sponsor::create($request->all());
            $sponsor = Sponsor::find($save->id);
            $sample = $sponsor->sample()->create([
                'sponsor_id' => $save->id
            ]);
            $user = $sponsor->user()->create([
                'email' => $request->input('contact_email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'sponsor'
            ]);
            return response()->json([
                'status_code' => 201,
                'user' => [
                    'email' => $request->input('contact_email'),
                    'password' => Hash::make($request->input('password')),
                    'role' => 'sponsor',
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'contact_number' => $request->input('contact_number'),
                    'address' => $request->input('address')
                ]
            ], 201);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }

    }

    public function uploadToSample(Request $request, $id, $file_type) {
        try {
            $sponsor = Sponsor::where('id', $id);
            $reg = SponsorSample::where('sponsor_id', $id, $file_type);
            if ($file = $request->file($file_type)) {
                $path = $file->store('public/sponsor');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);

                $reg->update([
                    $file_type => $path,

                ]);
                $sponsor->content_approved = 0;
                $sponsor->save();

                return response()->json([
                    'message' => 'Upload Success'
                ], 201);
            }
        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function updateInfo(Request $request, $id) {
        try {
            $reg = Sponsor::where('id', $id)->first();
            $reg->update($request->all());
            $reg->save();
            return response()->json([
                'message' => $reg
            ], 200);
        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function viewSampleBooth($id) {
        try {
            $reg = SponsorSample::where('sponsor_id', $id)->first();
            return response()->json($reg);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function approveBooth($id) {
        try {
            $sponsor = Sponsor::where('id', $id)->first();
            $sample = SponsorSample::where('sponsor_id', $id)->first();
            $sponsor->update([
                'banner_file' => $sample->banner_file,
                'logo_file' => $sample->logo_file,
                'facebook_url' => $sample->facebook_url,
                // 'website' => $sample->website, // remove by abing
                'video_url1' => $sample->video_url1,
                'video_url2' => $sample->video_url2,
                'video_url3' => $sample->video_url3,
                'bannerstand1' => $sample->bannerstand1,
                'bannerstand2' => $sample->bannerstand2,
                'bannerstand3' => $sample->bannerstand3,
                'bannerstand4' => $sample->bannerstand4,
                'magazinestand1' => $sample->magazinestand1,
                'magazinestand2' => $sample->magazinestand2,
                // added by adbing
                'avp1' => $sample->avp1,
                'avp2' => $sample->avp2,
                'avp3' => $sample->avp3,
                'avp4' => $sample->avp4,
                'avp5' => $sample->avp5,
                'avp6' => $sample->avp6,
                'avp7' => $sample->avp7,
                'avp8' => $sample->avp8,
                'avp9' => $sample->avp9,
                'avp10' => $sample->avp10,
                'product_intro' => $sample->product_intro,
                ///
                'content_approved' => 1,
                'wall_background' => $sample->wall_background
            ]);
            $sample->draft_approved = 1;
            $sponsor->save();
            $sample->save();

            return response()->json($sponsor, 202);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function declineSampleBooth(Request $request, $id) {
        try {
            $sample = SponsorSample::where('sponsor_id', $id)->first();
            $sample->comment = $request->comment;
            $sample->draft_approved = 0;
            $sample->save();
            return response()->json($sample, 202);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getAllPendingSponsorBooth() {
        try {
            $sponsors = new Sponsor;
            $data = $sponsors->getAllPendingReviews();
            return response()->json($data);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getAllSponsors() {
        try {
            $sponsors = new Sponsor;
            $data = $sponsors->getAllApprovedBooths();
            return response()->json($data);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    //added by abing
    public function getAllSponsorProducts($id) {
        try {
            $products = SponsorProducts::where('sponsor_id', $id)->get();
            return response()->json($products);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }


    //added by abing
    public function getAllSponsorResources($id) {
        try {
            $resources = SponsorResources::where('sponsor_id', $id)->get();
            return response()->json($resources);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    //added by abing
    public function getSponsorProfileBooth($id) {
        try {
            $sponsor = Sponsor::find($id);
            return response()->json($sponsor);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

}
