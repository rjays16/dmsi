<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    public $table = "attendees";
    protected $fillable = [
        'email',
        'session_id',
        'user_id',
        'first_name',
        'last_name'
    ];

    public function session() {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
