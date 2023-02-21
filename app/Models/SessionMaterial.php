<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMaterial extends Model
{
    use HasFactory;
    public $table = "session_materials";

    protected $fillable = [
        'session_id',
        'file_path',
        'file_name'
    ];

    public function session() {
        return $this->belongsTo(MiniSession::class, 'session_id');
    }
}
