<?php

namespace App\Http\Controllers;

use App\Models\ConventionContest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ThankYouMail;

class ConventionContestController extends Controller
{

    public function editResearchPosterEntry(Request $request)
    {

        DB::beginTransaction();

        try {
            $item =  ConventionContest::findOrFail($request->id);
            $item->contest_title = $request->contest_title;
            $item->contest_author = $request->contest_author;
            $item->contest_institution = $request->contest_institution;
            $item->contest_video = $request->contest_video;
            if ($request->hasFile('contest_pdf')) {
                $file = $request->file('contest_pdf');
                $path = $file->store('public/contest');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);
                $item->contest_pdf = $path;
            }
            $item->save();
            DB::commit();
            return response()->json('success', 200);
        } catch (exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e
            ], 400);
        }

    }

    public function editOralResearchEntry(Request $request)
    {
        DB::beginTransaction();

        try {
            $item =  ConventionContest::findOrFail($request->id);
            $item->contest_title = $request->contest_title;
            $item->contest_author = $request->contest_author;
            $item->contest_institution = $request->contest_institution;
            if ($request->hasFile('contest_pdf')) {
                $file = $request->file('contest_pdf');
                $path = $file->store('public/contest');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);
                $item->contest_pdf = $path;
            }
            $item->save();
            DB::commit();
            return response()->json('success', 200);
        } catch (exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function editPhotoContestEntry(Request $request)
    {


        DB::beginTransaction();

        try {
            $item =  ConventionContest::findOrFail($request->id);
            $item->contest_title = $request->contest_title;
            $item->contest_author = $request->contest_author;
            if ($request->hasFile('contest_image')) {
                $file = $request->file('contest_image');
                $path = $file->store('public/contest');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);
                $item->contest_image = $path;
            }
            $item->save();
            DB::commit();
            return response()->json('success', 200);
        } catch (exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e
            ], 400);
        }
    }


    public function setRank(Request $request)
    {
        DB::beginTransaction();
        try {
            $item =  ConventionContest::findOrFail($request->id);
            if(empty($request->rank_number)){
                $item->rank_number = 0;
            }else{
                if($request->rank_number == null || $request->rank_number == 'null'){
                    $item->rank_number = 0;
                }else{
                    $item->rank_number = $request->rank_number;
                }

            }

            $item->save();
            DB::commit();
            return response()->json('success', 200);
        } catch (exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contest = ConventionContest::all();
            return response()->json($contest);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contest_author' => 'required',
            'contest_title' => 'required',
            'contest_institution' => 'required'
        ]);
        $messages = [
            'required' => 'The check the fields required.',
        ];
        if ($validator->fails()) {
            // return redirect('post/create')->withErrors($validator)->withInput();
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 403);
        }

        $save = ConventionContest::create($request->all());

        return response()->json([
            'status_code' => 201,
            'room' => $data
        ], 201);
    }

    public function uploadFiles(Request $request, $id, $file_type)
    {
        try {
            $reg = ConventionContest::find($id);
            if ($file = $request->file($file_type)) {
                $path = $file->store('public/contest');
                $name = $file->getClientOriginalName();
                $url = Storage::url($name);

                $reg->update([
                    $file_type => $path,
                ]);
                return response()->json([
                    'message' => 'Upload Success'
                ], 201);
            }
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConventionContest  $conventionContest
     * @return \Illuminate\Http\Response
     */
    public function show(ConventionContest $conventionContest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConventionContest  $conventionContest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConventionContest $conventionContest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConventionContest  $conventionContest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConventionContest $conventionContest)
    {
        //
    }

    // Create
    public function createPosterResearch(Request $request)
    {

        if ($file = $request->file('contest_pdf')) {
            $path = $file->store('public/contest');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $data = ConventionContest::create([
                'contest_author' => $request['contest_author'],
                'contest_title' => $request['contest_title'],
                'contest_institution' => $request['contest_institution'],
                'contest_pdf' => $path,
                'contest_video' => $request['contest_video'],
                'contest_type' => 'Poster Research'
            ]);
        }

        return response()->json([
            'status_code' => 201,
            'room' => $data
        ], 201);
    }

    public function createOralResearch(Request $request)
    {

        if ($file = $request->file('contest_pdf')) {
            $path = $file->store('public/contest');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $data = ConventionContest::create([
                'contest_author' => $request['contest_author'],
                'contest_title' => $request['contest_title'],
                'contest_institution' => $request['contest_institution'],
                'contest_pdf' => $path,
                'contest_type' => 'Oral Research'
            ]);
        }

        return response()->json([
            'status_code' => 201,
            'room' => $data
        ], 201);
    }

    public function createPhotography(Request $request)
    {

        if ($file = $request->file('contest_image')) {
            $path = $file->store('public/contest');
            $name = $file->getClientOriginalName();
            $url = Storage::url($name);
            $data = ConventionContest::create([
                'contest_author' => $request['contest_author'],
                'contest_title' => $request['contest_title'],
                'contest_image' => $path,
                'contest_type' => 'Photography Contest'
            ]);
        }

        return response()->json([
            'status_code' => 201,
            'room' => $data
        ], 201);
    }

    // Delete
    public function deletePosterResearch($id)
    {
        try {
            $entry = ConventionContest::findOrFail($id);
            $file = $entry->contest_pdf;
            Storage::delete($file);
            $entry->delete();
            return response()->json([
                'message' => 'file deleted'
            ]);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ]);
        }
    }

    public function deleteOralResearch($id)
    {
        try {
            $entry = ConventionContest::findOrFail($id);
            $file = $entry->contest_pdf;
            Storage::delete($file);
            $entry->delete();
            return response()->json([
                'message' => 'file deleted'
            ]);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ]);
        }
    }


    // Get
    public function getPosterResearchEntries()
    {
        try {
            $contest = ConventionContest::where('contest_type', 'Poster Research')
                ->orderByRaw('rank_number = 0, rank_number')
                ->latest()
                ->get();
            return response()->json($contest);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getOralResearchEntries()
    {
        try {
            $contest = ConventionContest::where('contest_type', 'Oral Research')
                ->orderByRaw('rank_number = 0, rank_number')
                ->latest()
                ->get();
            return response()->json($contest);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getPhotographyEntries()
    {
        try {
            $contest = ConventionContest::where('contest_type', 'Photography Contest')
                ->orderByRaw('rank_number = 0, rank_number')
                ->latest()
                ->get();
            return response()->json($contest);
        } catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }
}
