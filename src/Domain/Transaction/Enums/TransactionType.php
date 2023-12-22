<?php

namespace Hrgweb\SalesAndInventory\Domain\Transaction\Enums;

enum TransactionType: string
{
    case PURCHASE = 'purchase';
    case SALE = 'sale';
    case ADJUSTMENTS = 'adjustments';
}
