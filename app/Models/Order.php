<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\OrderType;
use App\Models\OrderStatus;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'orders';

    protected $fillable = [
        'pcr_member_id',
        'amount',
        'year',
        'type',
        'collection_type_id',
        'admin_notes',
        'member_notes',
        'status',
        'is_claimed',
        'convenience_fee',
    ];

    protected $appends = [
        'order_type_name',
        'order_status_name',
        'order_payments'
    ];

    public function pcr_member() {
        return $this->belongsTo(PCRMember::class, 'pcr_member_id');
    }

    public function transaction() {
		return $this->hasOne(Transactions::class, 'order_id');
	}

    public function collection_fee() {
        return $this->belongsTo(CollectionFee::class, 'collection_type_id');
    }

    public function payment() {
		return $this->hasOne(Payment::class, 'order_id');
	}

    public function payments() {
		return $this->hasMany(Payment::class, 'order_id');
	}

    public function getOrderStatusNameAttribute() {
        $status = $this->status;

        $name = OrderStatus::where('id', $status)->first();

        if(!is_null($name)) {
            $name = $name->name;
        } else {
            $name = null;
        }

        return $name;
    }

    public function getOrderTypeNameAttribute() {
        $type = $this->type;

        $name = OrderType::where('id', $type)->first();

        if(!is_null($name)) {
            $name = $name->name;
        } else {
            $name = null;
        }

        return $name;
    }

    public function getOrderPaymentsAttribute() {
        $payment_total = 0;
        $order_payments = $this->payments;
        if(!empty($order_payments)) {
            $payment_total = $order_payments->sum('amount');

            if($payment_total > $this->collection_fee->amount) {
                $payment_total = $this->collection_fee->amount;
            }
        }

        return $payment_total;
    }
}
