<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class PaymentMethodEnum extends Enum
{
    // constants
    const IDEAPAY = 1;
    const BANK = 2;
    const CHECK = 3;
}