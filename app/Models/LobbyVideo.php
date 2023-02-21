<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LobbyVideo extends Model
{
    public $table = "lobby_videos";
    protected $fillable = [
        'video_name',
        'video_url'
    ];
}
