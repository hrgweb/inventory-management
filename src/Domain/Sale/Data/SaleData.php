<?php

namespace Hrgweb\InventoryManagement\Domain\Sale\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Hrgweb\InventoryManagement\Domain\Order\Data\OrderData;

class SaleData extends Data
{
    public function __construct(
        public string $transaction_session_no,
        #[DataCollectionOf(OrderData::class)]
        public DataCollection $orders,
        public float $grand_total,
        public float $amount,
        public ?float $change,
        public ?array $product_count_occurences
    ) {
    }
}
