<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use DB;

class ElectionPeriod extends Model
{
    public $table = "election_period";
    
    protected $fillable = [
        'year',
        'date_started',
        'date_end',
        'is_active'
    ];

    public function nominees() {
        return $this->hasMany(ElectionNominee::class, 'election_period_id');
    }

    public function getElectionPeriod($status,$user) {
        $type = ($status == 'active') ? 1 : 0;
        $mytime = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        if($status == 'active') {
            if($user == 'admin') {
                return self::where('is_active', $type)
                ->where('date_end','>',$mytime )
                ->orderBy('id', 'asc')
                ->get();
            }else {
                return self::where('is_active', $type)
                ->where('date_started','<',$mytime )
                ->where('date_end','>',$mytime )
                ->orderBy('id', 'asc')
                ->get();
            }
        } else {
            return self::where('is_active', $type)
            ->orderBy('id', 'asc')
            ->get();
        }       
    }

    public function getElectionPeriodDetails($id) {
        return self::where('id', $id)
        ->get();
    }

    public static function getTotalVotes($id) {
        $total_votes = DB::select("SELECT count(DISTINCT voted_by) as total_votes
            from election_nominees
            left join election_votes on election_nominees.id = election_votes.election_nominee_id
            where election_nominees.election_period_id = $id")[0]->total_votes;

        return $total_votes;
    }
}