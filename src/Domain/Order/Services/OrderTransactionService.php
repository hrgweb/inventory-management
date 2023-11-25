<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Services;

use Hrgweb\SalesAndInventory\Models\OrderTransaction;
use Exception;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\OrderStatus;

class OrderTransactionService
{
    protected static function generator()
    {
        return str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function generate(): string
    {
        $session = OrderTransaction::where('status', OrderStatus::PENDING)->latest('id')->first()?->transaction_session;

        // if no pending transaction session
        if (!$session) {
            // then create one
            $orderTransaction = OrderTransaction::create(['transaction_session' => static::generator()]);

            if (!$orderTransaction) {
                throw new Exception('no transaction session generated. encountered an error');
            }

            return $orderTransaction->transaction_session;
        }

        return $session;
    }
}
