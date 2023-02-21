<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class OrderTypeEnum extends Enum
{
    const MEMBERSHIP = 1;
    const PMA = 2;
    const COMPUTERIZATION = 3;
    const SEMINAR = 4;
    const OTHERS = 5;
    const GOOD_STANDING = 6;
}