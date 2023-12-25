<?php

namespace Hrgweb\SalesAndInventory\Domain\Transaction\Data;

use Spatie\LaravelData\Data;
use Hrgweb\SalesAndInventory\Domain\Product\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\Transaction\Enums\TransactionType;

class TransactionData extends Data
{
    public function __construct(
        public ProductData $product,
        public TransactionType $transaction_type,
        // public int $qty,
        // public float $cost_price,
        // public float $selling_price,
        // public ?float $total_cost,
        // public ?int $qty_change,
        // public ?float $subtotal,
        public ?string $notes,
    ) {
        $this->transaction_type ??= TransactionType::PURCHASE;
        // $this->qty_change ??= 0;
        // $this->subtotal = $this->cost_price * $this->qty;
    }
}
