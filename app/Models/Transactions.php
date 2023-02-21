<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'transactions';

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function ideapay() {
        return $this->belongsTo(Ideapay::class, 'ideapay_id');
    }

    public function deposit_slip() {
        return $this->belongsTo(DepositSlip::class, 'deposit_slip_id');
    }
}
