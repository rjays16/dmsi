<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAttendee extends Model
{
    use HasFactory;
    public $table = "session_attendees";

    protected $fillable = [
        'session_id',
        'reg_id'
    ];

    public function session() {
        return $this->belongsTo(MiniSession::class, 'session_id');
    }

    public function user_registration() {
        return $this->belongsTo(Registration::class, 'reg_id');
    }
}
