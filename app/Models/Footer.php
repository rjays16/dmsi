<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    public $table = "footers";
    protected $fillable = [
        'footer_rights_text',
        'footer_logo_img'
    ];
}
