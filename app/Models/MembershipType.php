<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    use HasFactory;
    public $table = "membership_types";

    public function registration() {
        return $this->belongsTo(Registration::class);
    }
}
