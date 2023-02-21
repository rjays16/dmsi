<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    public $table = "announcements";

    protected $fillable = [
        'title',
        'body_text',
        'category',
        'file_path'
    ];
}
