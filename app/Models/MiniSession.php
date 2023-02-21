<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniSession extends Model
{
    use HasFactory;
    public $table = "mini_sessions";

    protected $fillable = [
        'topic',
        'zoom_email',
        'zoom_key',
        'zoom_secret',
        'start_time',
        'end_time',
        'room_name',
        'scheduled_date',
        'join_url',
        'start_url',
        'sponsor_id',
        'description',
        'max_user'
    ];

    public function sponsor() {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }
}
