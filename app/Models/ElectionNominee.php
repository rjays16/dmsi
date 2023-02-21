<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionNominee extends Model
{
  

    use HasFactory;
    public $table = "election_nominees";

    protected $fillable = [
        'election_period_id',
        'member_id',
        'short_bio'
    ];

    public function pcr_member() {
        return $this->belongsTo(PCRMember::class,'member_id');
    }

    public function votes() {
        return $this->hasMany(ElectionVote::class,'election_nominee_id');
    }
}
