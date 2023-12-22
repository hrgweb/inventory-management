<?php

namespace Hrgweb\SalesAndInventory\Domain\Sale\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Hrgweb\SalesAndInventory\Domain\Order\Data\OrderData;

class SaleData extends Data
{
    public function __construct(
        public string $transaction_session_no,
        #[DataCollectionOf(OrderData::class)]
        public DataCollection $orders,
    ) {
    }
}
