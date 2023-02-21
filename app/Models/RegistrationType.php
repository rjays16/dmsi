<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationType extends Model
{
    use HasFactory;

    public $table = "registration_types";

    public function registration() {
        return $this->belongsTo(Registration::class);
    }
}
