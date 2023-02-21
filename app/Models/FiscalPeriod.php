<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FiscalPeriod extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "fiscal_periods";

    protected $fillable = [
        'start_period',
        'end_period',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function scopeActive($query) {
		return $query->where('is_active', true);
	}

    public static function getActive() {
        return self::active()->first();
    }
}