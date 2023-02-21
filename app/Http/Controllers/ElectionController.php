<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectionPeriod;
use App\Models\ElectionNominee;
use App\Models\ElectionVote;
use App\Models\PCRMember;
use App\Models\PCRChapter;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PCRElectionResultExport;
use App\Exports\EligibilityForElectionExport;

class ElectionController extends Controller
{
    public function create(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'year' => 'required',
                'date_started' => 'required',
                'date_end' => 'required'
            ]);
            $messages = [
                'required' => 'The field is required.'
            ];
            if ($validator->fails()) {
                // return redirect('post/create')->withErrors($validator)->withInput();
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 400);
            }
            
            $date_stated = $request->date_started;
            $year = $request->year;
            $period_exists = ElectionPeriod::where(function($query) use ($date_stated, $year) {
                $query->where('year', $year)->where('date_started', 'like', "%$date_stated");
            })->exists();
            if ($period_exists) {
                return response()->json([
                    'status_code' => 401,
                    'response' => 'You cannot create another period on the same day.'
                ], 400);
            }
            else {
                //Creating na part of the equation
                $save = ElectionPeriod::create($request->all());
                return response()->json([
                    'status_code' => 201,
                    'election_period' => $save
                ], 201);
            }
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function nominate(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'election_period_id' => 'required',
                'member_id' => 'required',
                'short_bio' => 'required'
            ]);

            $messages = [
                'required' => 'The field is required.'
            ];

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 400);
            }

            $num_nominees = ElectionNominee::where('election_period_id', $request->election_period_id)->count();
            $max_nominees = 14;

            if($num_nominees == $max_nominees) {
                return response()->json([
                    'message' => "You have already reached the max limit of nominees (Max: $max_nominees)"
                ], 400);
            } else {
                $nominees = ElectionNominee::create($request->all());
                return response()->json([
                    'status_code' => 201,
                    'nominated' => $nominees
                ], 201);
            }
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function vote(Request $request){
        $nominees = $request->selected_member;
        $voter_id = $request->voter_id;
        $period_id = $request->period_id;

        $save = array();
        foreach ($nominees as $nominee){ 
            $data = ElectionNominee::where('election_period_id', $period_id)
                                     ->where('member_id', $nominee)->get();

            $voteData = array('election_nominee_id' => $data[0]->id, 'voted_by' => $voter_id);
            $save[] = ElectionVote::create($voteData);
        }
        return response()->json([
            'status_code' => 201,
            'voted' => count($save)
        ], 201);
    }

    public function getNomineeDetails($id) {
        $nominees = ElectionNominee::where('election_period_id',$id)->get();
        $member = array();
        foreach ($nominees as $nominee){ 
            $application = PCRMember::find($nominee->member_id);
            $application['short_bio'] = $nominee->short_bio;
            if($application->email != null){
                $user = User::where('email', $application->email)->first();
                $registration = Registration::where('email', $application->email)->get();
                $regcount = $registration->count();
                if($regcount == 1){
                    $application['prof_suffix'] = $registration[0]['prof_suffix'];
                    $application['prof_suffix_other'] = $registration[0]['prof_suffix_other'];
                    $application['suffix_name'] = $registration[0]['suffix_name'];
                }
                if($user->userable_type){
                    if ($user->userable_type == "App\Models\PCRMember") {
                        // dd(config('app.mem_url'));
                        $explode_path = explode('/', $user->profile_pic);
                        unset($explode_path[0]);
                        $implode_path = implode('/', $explode_path);
                        $application['profile_pic'] =url("storage/" . $implode_path);
                     
                    }
                    else {
                        $explode_path = explode('/', $user->profile_pic);
                        unset($explode_path[0]);
                        $implode_path = implode('/', $explode_path);
                        $application['profile_pic'] = "storage/" . $implode_path;
                      
                    }
                }
               
            }else {
                $application['prof_suffix'] = "";
                $application['prof_suffix_other'] = "";
                $application['suffix_name'] = "";
                $application['profile_pic'] ="";
                
            }  
            $member[] = $application;
        }
        return response()->json($member, 200);
       
   }

    public function close(Request $request, $id) {
        try {
            $update = ElectionPeriod::where('id', $id)->first();
            $update->update($request->all());
            //$update->save();
            return response()->json([
                'message' => $update
            ], 200);
        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function checkVoteStatus($member,$election){
        $nominee = ElectionVote::join('election_nominees', function ($join) use ($election) {
            $join->on('election_nominees.id', '=', 'election_votes.election_nominee_id')
                 ->where('election_nominees.election_period_id', '=', $election);
        })->where('voted_by', $member)
        ->get();
        return response()->json($nominee, 200);   
    }

    public function updateNominated(Request $request, $id) {
        try {
            $update = ElectionNominee::where('id', $id)->first();
            $update->update($request->all());
            return response()->json([
                'message' => $update
            ], 200);
        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function deleteNominee($id) {
        try {
            $nominee = ElectionNominee::find($id);
            $nominee->delete();
            return response()->json([
                'message' => 'Delete Success'
            ], 202);

        }
        catch(exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function searchNominees(Request $request) {
        try {
            $keyword = $request->keyword;
            $id = $request->id;
           
            $members = PCRMember::where(function($query) use ($keyword) {
                $query->where('first_name', 'like', "%$keyword%")
                ->orWhere('last_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
            })->with([
                'pcr_chapter:id,chapter_name'
            ])->whereNotIn('pcr_members.id', ElectionNominee::select('member_id')->where('election_period_id', '=', $id)->get())
            ->where('is_approved', 1)
            ->get();

            return response()->json($members);
        }
        catch (exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function searchNominated(Request $request) {
        try {
            $keyword = $request->keyword;
            $id = $request->id;
          
            $nominees = ElectionNominee::with(["pcr_member" => function($query) use ($keyword){
                    $query->where('pcr_members.first_name', 'like', "%$keyword%")
                    ->orWhere('pcr_members.last_name', 'like', "%$keyword%")
                    ->orWhere('pcr_members.email', 'like', "%$keyword%");
                }])->with([
                    
                    'votes:election_nominee_id'
                ])
                ->where('election_period_id',$id)
                ->get();
            return response()->json($nominees);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getElectionPeriod($status,$user) {
        try {
            $election_period = new ElectionPeriod;
            $data = $election_period->getElectionPeriod($status,$user);
            return response()->json($data);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function checkActiveElection(){
        try {
             $mytime = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
            $check = ElectionPeriod::where('is_active', 1)
            ->where('date_end','<',$mytime )->get();
            $checkcount = $check->count();
            if($checkcount >= 1){
                foreach ($check as $period){ 
                    ElectionPeriod::where('id',$period->id)->update(['is_active' => 0]);
                }
            }
            return response()->json($check);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getNominees($id) {
        try {
            $nominees = ElectionNominee::where('election_period_id',$id)
            ->with([
                'pcr_member:id,first_name,last_name,middle_name,email,prc_number',
                'votes:election_nominee_id'
            ])
            ->get();
            return response()->json($nominees);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getElectionPeriodNominees($id,Request $request){
        try {
            
            $page = $request->page;
            $members = PCRMember::with([
                'pcr_chapter:id,chapter_name'
            ])->whereNotIn('pcr_members.id', ElectionNominee::select('member_id')->where('election_period_id', '=', $id)->get())
            ->where('is_approved', 1)
            ->orderBy('last_name', 'asc')
            ->latest()
            ->paginate(20);
          
            return response()->json($members);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function getMember($id) {
        $application = PCRMember::find($id);
        if($application->email != null){
            $user = User::where('email', $application->email)->first();
            $registration = Registration::where('email', $application->email)->get();
            $regcount = $registration->count();
            if($regcount == 1){
                $application['prof_suffix'] = $registration[0]['prof_suffix'];
                $application['prof_suffix_other'] = $registration[0]['prof_suffix_other'];
                $application['suffix_name'] = $registration[0]['suffix_name'];
            }
            if($user->userable_type){
                if ($user->userable_type == "App\Models\PCRMember") {
                    // dd(config('app.mem_url'));
                    $explode_path = explode('/', $user->profile_pic);
                    unset($explode_path[0]);
                    $implode_path = implode('/', $explode_path);
                    $application['profile_pic'] =url("storage/" . $implode_path);
                    return response()->json($application, 200);
                }
                else {
                    $explode_path = explode('/', $user->profile_pic);
                    unset($explode_path[0]);
                    $implode_path = implode('/', $explode_path);
                    $application['profile_pic'] = "storage/" . $implode_path;
                    return response()->json($application, 200);
                }
            }
           
        }else {
            $application['prof_suffix'] = "";
            $application['prof_suffix_other'] = "";
            $application['suffix_name'] = "";
            $application['profile_pic'] ="";
            return response()->json($application, 200);
        }  
    }
    
    public function export(Request $request) 
    {
        return Excel::download(new PCRElectionResultExport($request->id), 'Result.xlsx');
    }

    public function getSelectedNominees(Request $request) {
        $selected_nominee = $request->selected_member;
        $application = PCRMember::find($selected_nominee);
       
        return response()->json($application, 200);
    }
  
    public function checkNominee($period_id,$member_id) {
        $nominee = ElectionNominee::where([
            ['election_period_id', '=', $period_id],
            ['member_id', '=', $member_id]
        ])->get();
        return response()->json($nominee, 200);   
    }

    public function getElectionPeriodDetails($id) {
        try {
            $election_period = new ElectionPeriod;
            $data = $election_period->getElectionPeriodDetails($id);
            return response()->json($data);
        }
        catch (exception $e) {
            return response()->json([
                'message' => $e
            ], 400);
        }
    }

    public function exportMemberEligibility() {
        return Excel::download(new EligibilityForElectionExport(), 'member_eligibility.csv');
    }
}