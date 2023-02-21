<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDepositSlip extends Model
{
    use HasFactory;
    public $table = "member_deposit_slips";

    protected $fillable = [
        'member_id',
        'file_path',
        'month',
        'date',
        'year'
    ];

    public function pcr_member() {
        return $this->belongsTo(PCRMember::class);
    }
}
