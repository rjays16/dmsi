<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlenaryVideo extends Model
{
    public $table = "plenary_hall";
    protected $fillable = [
        'video_name',
        'video_url',
        'chat_url'
    ];
}
