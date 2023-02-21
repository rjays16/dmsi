<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ideapay extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'ideapay';

    public function ideapayStatus() {
        return $this->belongsTo(IdeapayStatus::class, 'status');
    }

    public function transaction() {
        return $this->hasOne(Transactions::class, 'ideapay_id');
    }
}
