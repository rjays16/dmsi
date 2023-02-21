<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRCNumber extends Model
{
    use HasFactory;
    public $table = "prc_numbers";

    public function registration() {
        return $this->belongsTo(Registration::class);
    }
}
