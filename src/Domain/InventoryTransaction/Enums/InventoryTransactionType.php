<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Enums;

enum InventoryTransactionType: string
{
    case PURCHASE = 'purchase';
    case SALE = 'sale';
    case ADJUSTMENTS = 'adjustments';
}
