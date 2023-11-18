<?php

namespace Hrgweb\SalesAndInventory\Domain\Sale\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Hrgweb\SalesAndInventory\Domain\Order\Data\OrderData;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\PaymentMethod;
use Hrgweb\SalesAndInventory\Domain\Sale\Enums\TransactionStatus;

class SaleData extends Data
{
    public function __construct(
        public ?string $order_transaction_session,
        public ?int $cashier_id,
        public ?int $customer_id,
        #[DataCollectionOf(OrderData::class)]
        public DataCollection $orders,
        public ?PaymentMethod $payment_method,
        public ?float $discount_applied,
        public ?float $tax_amount,
        public ?float $total_amount,
        public ?TransactionStatus $transaction_status,
        public ?string $notes,
        public ?string $invoice_number,
        public ?float $refund_amount,
    ) {
        $this->cashier_id ??= 1;
        $this->customer_id ??= 1;
        $this->payment_method ??= PaymentMethod::CASH;
        $this->discount_applied ??= 0;
        $this->tax_amount ??= 0;
        $this->total_amount ??= 0;
        $this->transaction_status ??= TransactionStatus::COMPLETED;
    }
}
