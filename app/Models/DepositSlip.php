<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositSlip extends Model
{
    use SoftDeletes;
    public $table = 'deposit_slips';

    protected $fillable = [
        'user_id',
        'path',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'deposit_slip_id');
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'deposit_slip_id');
    }
}