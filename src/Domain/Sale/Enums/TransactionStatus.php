<?php

namespace Hrgweb\SalesAndInventory\Domain\Sale\Enums;

enum TransactionStatus: string
{
    case COMPLETED = 'completed';
    case VOIDED = 'voided';
    case PENDING = 'pending';
}
