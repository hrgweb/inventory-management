<?php

namespace Hrgweb\SalesAndInventory\Domain\Order\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\Order;
use Hrgweb\SalesAndInventory\Domain\Order\Data\OrderData;
use Spatie\LaravelData\DataCollection;

class OrderService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
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

    public static function list($transactionSession = ''): mixed
    {
        return OrderData::collection(Order::where('order_transaction_session', $transactionSession)->get());
    }
}
