<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model
{
    use HasFactory;
    public $table = "voucher_codes";

    protected $fillable = [
        'voucher_code',
        'description',
        'discount_amt',
        'max_usage',
        'note'
    ];

    public function getAll() {
        $data = self::get();

        return $data;
    }
}
