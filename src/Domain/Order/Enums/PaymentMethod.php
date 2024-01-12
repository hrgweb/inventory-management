<?php

namespace Hrgweb\InventoryManagement\Domain\Order\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case DEBIT_CARD = 'debit_card';
    case CREDIT_CARD = 'credit_card';
    case PAYPAL = 'paypal';
}
