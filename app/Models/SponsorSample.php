<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorSample extends Model
{
    use HasFactory;

    public $table = "sponsor_samples";

    protected $fillable = [
        'sponsor_id',
        'banner_file',
        'logo_file',
        'facebook_url',
        'website',
        'video_url1',
        'video_url2',
        'video_url3',
        'bannerstand1',
        'bannerstand2',
        'bannerstand3',
        'bannerstand4',
        'magazinestand1',
        'magazinestand2',
        'comment',
        'draft_approved',
        'wall_background'
    ];

    public function sponsor() {
        return $this->belongsTo(Sponsor::class);
    }
}
