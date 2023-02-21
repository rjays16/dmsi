<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    public $table = "sessions";

    protected $fillable = [
        'topic',
        'start_time',
        'duration_hours',
        'scheduled_date',
        'join_url',
        'start_url',
        'description',
        'max_user',
        'room_id',
        'event_id',
        'event_name'
    ];

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function attendees() {
        return $this->hasMany(Attendees::class, 'session_id');
    }
}
