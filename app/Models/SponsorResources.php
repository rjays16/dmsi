<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorResources extends Model
{
    use HasFactory;
    public $table = "sponsor_resources";

    protected $fillable = [
        'sponsor_id',
        'file_path'
    ];

    public function sponsor() {
        return $this->belongsTo(Sponsor::class, 'id');
    }
}
