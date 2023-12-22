<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\Order;
use Hrgweb\SalesAndInventory\Domain\Order\Data\OrderData;

class OrderService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public static function fetch($transactionSessionNo = ''): mixed
    {
        return OrderData::collection(Order::where('transaction_session_no', $transactionSessionNo)->get());
    }

    public function save()
    {
        $order = Order::create($this->request);

        if (!$order) {
            throw new Exception('no order saved. encountered an error.');
        }

        Log::info('1 order saved.');

        return OrderData::from($order)->additional(['created_at' => $order->created_at]);
    }


}
