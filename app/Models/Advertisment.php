<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;
    public $table = "advertisments";

    protected $fillable = [
        'title',
        'body_text',
        'order',
        'file_path'
    ];
}
