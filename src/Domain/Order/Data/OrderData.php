<?php

namespace Hrgweb\InventoryManagement\Domain\Order\Data;

use Spatie\LaravelData\Data;
use Hrgweb\InventoryManagement\Models\Order;
use Hrgweb\InventoryManagement\Domain\Order\Enums\OrderStatus;
use Hrgweb\InventoryManagement\Domain\Product\Data\ProductData;

class OrderData extends Data
{
    public function __construct(
        public ?int $id,
        public string $transaction_session_no,
        public ?ProductData $product,
        public ?float $selling_price,
        public ?int $qty,
        public ?float $subtotal,
        public ?OrderStatus $status,
        public ?string $notes
    ) {
        $this->selling_price ??= 0;
        $this->qty ??= 1;
        $this->subtotal = $this->selling_price * $this->qty;
    }

    public static function fromModel(Order $order): self
    {
        return new self(
            $order->id,
            $order->transaction_session_no,
            ProductData::from($order->product),
            $order->selling_price,
            $order->qty,
            $order->subtotal,
            OrderStatus::PENDING,
            $order->notes
        );
    }
}
