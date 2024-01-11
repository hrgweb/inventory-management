<?php

namespace Hrgweb\PosAndInventory\Domain\Order\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case DECLINED = 'declined';
}
