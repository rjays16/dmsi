<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class OrderStatusEnum extends Enum
{
    const PENDING = 1;
    const COMPLETED = 2;
    const FAILED = 3;
    const PARTIAL = 4;
    const FOR_APPROVAL = 5;
}
