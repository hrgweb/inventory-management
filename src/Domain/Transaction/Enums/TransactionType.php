<?php

namespace Hrgweb\InventoryManagement\Domain\Transaction\Enums;

enum TransactionType: string
{
    case PURCHASE = 'purchase';
    case SALE = 'sale';
    case ADJUSTMENTS = 'adjustment';
}
