<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorProducts extends Model
{
    use HasFactory;
    public $table = "sponsor_products";

    protected $fillable = [
        'sponsor_id',
        'name',
        'description',
        'img_path'
    ];

    public function sponsor() {
        return $this->belongsTo(Sponsor::class, 'id');
    }

}
