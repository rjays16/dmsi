<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;
    public $table = "user_logs";
    protected $fillable = [
        'type',
        'user_id'
    ];
}
