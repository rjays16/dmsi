<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $table = "tags";

    protected $fillable = [
        'tag_name'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
