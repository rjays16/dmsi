<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionVote extends Model
{
    public $table = "election_votes";
    protected $fillable = [
        'election_nominee_id',
        'voted_by'
    ];
    public static function scopeCountVote($query,$id){
        return $query
            ->where('election_nominee_id', $id)
            ->count();
    }

    

}
