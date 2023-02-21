<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedEvent extends Model
{
    use HasFactory;
    public $table = "related_events";

    protected $fillable = [
        'link_text',
        'link_photo',
        'link_url',
        'event_type'
    ];
}
