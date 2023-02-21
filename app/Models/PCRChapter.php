<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCRChapter extends Model
{
    use HasFactory;
    public $table = "pcr_chapters";

    public function registration() {
        return $this->belongsTo(Registration::class, 'id');
    }
    
}
