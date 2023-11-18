<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Data;

use Carbon\Carbon;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\OrderStatus;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\PaymentMethod;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\PaymentStatus;
use Spatie\LaravelData\Data;

class OrderData extends Data
{
    public function __construct(
        public string $order_transaction_session,
        public ?int $customer_id,
        public int $product_id,
        public ?string $product_name,
        public ?string $product_description,
        public ?float $selling_price,
        public ?int $qty,
        public ?float $subtotal,
        public ?Carbon $order_date,
        public ?Carbon $ship_date,
        public ?string $ship_address,
        public ?string $ship_city,
        public ?string $ship_reqion,
        public ?string $ship_country,
        public ?string $ship_post_code,
        public ?OrderStatus $order_status,
        public ?float $total_amount,
        public ?PaymentMethod $payment_method,
        public ?PaymentStatus $payment_status,
        public ?string $promo_code,
        public ?string $notes,

    ) {
        $this->customer_id ??= 1;
        $this->order_status ??= OrderStatus::PENDING;
        $this->selling_price ??= 0;
        $this->qty ??= 1;
        $this->subtotal = $this->total();
        $this->order_date = Carbon::now();
        $this->total_amount ??= 0;
        $this->payment_method ??= PaymentMethod::CASH;
        $this->payment_status ??= PaymentStatus::PENDING;
    }

    protected function total(): float
    {
        return $this->selling_price * $this->qty;
    }
}
