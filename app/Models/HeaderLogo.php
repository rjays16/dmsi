<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderLogo extends Model
{
    public $table = "header_logos";
    protected $fillable = [
        'header_logo_img',
        'header_company_name'
    ];
}
