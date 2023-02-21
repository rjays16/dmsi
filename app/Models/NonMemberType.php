<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonMemberType extends Model
{
    use HasFactory;
    public $table = "non_member_types";

    public function registration() {
        return $this->belongsTo(Registration::class);
    }
}
