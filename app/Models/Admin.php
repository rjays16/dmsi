<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $table = "admins";

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function admin_type() {
        return $this->hasOne(AdminType::class);
    }
}
