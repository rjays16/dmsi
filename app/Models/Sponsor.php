<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    public $table = "sponsors";

    protected $fillable = [
        'name',
        'description',
        'address',
        'contact_number',
        'contact_email',
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
        'type_id',
        'content_approved',
        'newly_edited',
        'content_comment',
        'avp1',
        'avp2',
        'avp3',
        'avp4',
        'avp5',
        'avp6',
        'avp7',
        'avp8',
        'avp9',
        'avp10',
        'product_intro',
        'wall_background',
        'order'
    ];

    public function getAllPendingReviews() {
        $data = self::where('content_approved', 0)
        ->orderBy('id', 'desc')
        ->get();

        return $data;
    }

    public function getAllApprovedBooths() {
        $data = self::where('content_approved', 1)
        ->orderBy('id', 'desc')
        ->get();

        return $data;
    }

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function sponsor_type() {
        return $this->hasOne(SponsorType::class);
    }

    public function sample() {
        return $this->hasOne(SponsorSample::class, 'sponsor_id');
    }
}
