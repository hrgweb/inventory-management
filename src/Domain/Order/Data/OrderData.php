<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Data;

use Spatie\LaravelData\Data;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\OrderStatus;

class OrderData extends Data
{
    public function __construct(
        public ?int $id,
        public string $transaction_session_no,
        public ?int $customer_id,
        public int $product_id,
        public ?string $product_name,
        public ?string $product_description,
        public ?float $selling_price,
        public ?int $qty,
        public ?float $subtotal,
        public ?OrderStatus $order_status,
    ) {
        $this->customer_id ??= 1;
        $this->order_status ??= OrderStatus::PENDING;
        $this->selling_price ??= 0;
        $this->qty ??= 1;
        $this->subtotal = $this->total();
    }

    protected function total(): float
    {
        return $this->selling_price * $this->qty;
    }
}
