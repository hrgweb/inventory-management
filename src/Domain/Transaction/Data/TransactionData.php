<?php

namespace Hrgweb\InventoryManagement\Domain\Transaction\Data;

use Spatie\LaravelData\Data;
use Hrgweb\InventoryManagement\Domain\Product\Data\ProductData;
use Hrgweb\InventoryManagement\Domain\Transaction\Enums\TransactionType;

class TransactionData extends Data
{
    public function __construct(
        public ?int $id,
        public ProductData $product,
        public TransactionType $transaction_type,
        public int $qty,
        // public float $cost_price,
        // public float $selling_price,
        // public ?float $subtotal,
        public ?string $notes,
    ) {
        $this->transaction_type ??= TransactionType::PURCHASE;
        // $this->subtotal = $this->cost_price * $this->qty;
    }
}
