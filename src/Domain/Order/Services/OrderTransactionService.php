<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Services;

use Hrgweb\SalesAndInventory\Models\OrderTransaction;
use Exception;

class OrderTransactionService
{
    protected static function generator()
    {
        return str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function generate()
    {
        $orderTransaction = OrderTransaction::create(['transaction_session' => static::generator()]);

        if (!$orderTransaction) {
            throw new Exception('no transaction session generated. encountered an error');
        }

        return response()->json(['transacton_session' => $orderTransaction->transaction_session]);
    }
}
