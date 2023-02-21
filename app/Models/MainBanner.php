<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    public $table = "main_banners";
    protected $fillable = [
        'image_file',
        'title1',
        'title2',
        'subheading',
        'cta_button_text',
        'cta_button_url',
        'page_type',
        'text_color'
    ];
}
