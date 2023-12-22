<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data;

use Spatie\LaravelData\Data;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Enums\InventoryTransactionType;

class InventoryTransactionData extends Data
{
    public function __construct(
        public ?int $product_id,
        public InventoryTransactionType $transaction_type,
        public ?int $qty_change,
        public float $unit_cost,
        public float $total_cost,
        public ?string $notes,
        public ProductData $product
    ) {
    }
}
