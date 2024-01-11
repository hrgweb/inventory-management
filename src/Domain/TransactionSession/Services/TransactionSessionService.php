<?php

namespace Hrgweb\PosAndInventory\Domain\TransactionSession\Services;

use Exception;
use Hrgweb\PosAndInventory\Models\TransactionSession;
use Hrgweb\PosAndInventory\Domain\Order\Enums\OrderStatus;

class TransactionSessionService
{
    protected static function generator()
    {
        return str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function create(): TransactionSession
    {
        return TransactionSession::create(['session_no' => static::generator()]);
    }

    // public static function new(): string
    // {
        // $session = TransactionSession::where('status', OrderStatus::PENDING)->latest('id')->first()?->session_no;

        // // if no pending transaction session
        // if (!$session) {
        //     // then create one
        //     $session = TransactionSession::create(['session_no' => static::generator()]);

        //     if (!$session) {
        //         throw new Exception('no transaction session generated. encountered an error');
        //     }

        //     return $session->session_no;
        // }

        // return $session;
    // }

    // public static function status($transactionSessionNo): string | null
    // {
    //     return TransactionSession::where('session_no', $transactionSessionNo)->first()?->status;
    // }
}
