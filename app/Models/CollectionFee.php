<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\OrderType;
use App\Models\FiscalPeriod;

class CollectionFee extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "collection_fees";

    protected $appends = [
        'payment_type_name'
    ];
    
    protected $fillable = [
        'payment_type',
        'year',
        'start_period',
        'end_period',
        'description',
        'amount',
        'status',
        'enable_deposit_slip',
        'valid_until',
        'fiscal_period_id',
        'enable_ideapay_fee'
    ];

    protected $casts = [
        'status' => 'boolean',
        'enable_deposit_slip' => 'boolean',
        'enable_ideapay_fee' => 'boolean',
    ];

    protected $dates = [
        'start_period',
        'end_period',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'collection_type_id');
    }

    public function fiscal_period() {
        return $this->belongsTo(FiscalPeriod::class, 'fiscal_period_id');
    }

    public function scopeActive($query) {
        return $query->where('status', true);
    }

    public function scopeForCurrentFiscalYear($query) {
        $active_fiscal_period = FiscalPeriod::active()->first();
		return is_null($active_fiscal_period) ? $query : $query->where('fiscal_period_id', $active_fiscal_period->id);
	}

    public function getPaymentTypeNameAttribute() {
        $name = OrderType::where('id', $this->payment_type)->first();

        if(!is_null($name)) {
            $name = $name->name;
        } else {
            $name = null;
        }

        return $name;
    }

    public static function getActiveForCurrentYear() {
        $year = date('Y');

        $collection_fees = self::where('status', 1)
            ->where('year', $year)
            ->get();

        return $collection_fees;
    }

    public static function getActiveForCurrentFiscalYear() {
        $active_fiscal_period = FiscalPeriod::active()->first();
        return is_null($active_fiscal_period) ? collect([]) : self::active()->forCurrentFiscalYear()->get();
    }    
}
