<?php

namespace Hrgweb\SalesAndInventory\Domain\Transaction\Data;

use Spatie\LaravelData\Data;
use Hrgweb\SalesAndInventory\Domain\Product\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\Transaction\Enums\TransactionType;

class TransactionData extends Data
{
    public function __construct(
        public TransactionType $transaction_type,
        public ProductData $product,
        public float $selling_price,
        public int $qty,
        public float $subtotal,
        public ?string $notes,
    ) {
        $this->transaction_type ??= TransactionType::PURCHASE;
    }
}
