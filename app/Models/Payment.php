<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\OrderStatus;

class Payment extends Model
{
  use HasFactory, SoftDeletes;
  public $table = "payments";
  
  protected $fillable = [
    'pcr_member_id',
    'payment_method',
    'order_id',
    'amount',
    'date_paid',
  ];

  public function order() {
		return $this->belongsTo(Order::class, 'order_id');
	}

  public function pcr_member() {
		return $this->belongsTo(PCRMember::class, 'pcr_member_id');
	}

  public function depost_slip_class() {
    return $this->belongsTo(DepositSlip::class, 'deposit_slip_id');
  }

	public function method() {
    return $this->belongsTo(PaymentMethod::class, 'payment_method');
  }
}