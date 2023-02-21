<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $table = "rooms";
    protected $fillable = [
        'zoom_email',
        'zoom_key',
        'zoom_secret',
        'room_name',
        'is_occupied'
    ];
}
