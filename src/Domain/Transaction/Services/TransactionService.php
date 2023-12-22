<?php

namespace Hrgweb\SalesAndInventory\Domain\Sale\Services;

use Exception;
use Hrgweb\SalesAndInventory\Models\Sale;
use Hrgweb\SalesAndInventory\Models\Order;
use Hrgweb\SalesAndInventory\Models\TransactionSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Domain\Order\Enums\OrderStatus;
use Hrgweb\SalesAndInventory\Domain\Sale\Enums\TransactionStatus;

class TransactionService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function save(): JsonResponse
    {
        return $this->request;

        $orders = collect($this->request['orders']);
        $ordersCount = $orders->count();

        // no orders made
        if ($ordersCount <= 0) {
            return response()->json('please made an order.', 500);
        }

        DB::beginTransaction();
        try {
            $body = array_merge($this->request, ['total_amount' => $this->total()]);

            // made a sale
            $sale = Sale::create($body);

            if (!$sale) {
                throw new Exception('saving order encountered an error');
            }

            // update order status
            Order::where('order_transaction_session', $body['order_transaction_session'])->update(['order_status' => OrderStatus::COMPLETED]);

            // update transaction session
            TransactionSession::where('transaction_session', $body['order_transaction_session'])->update(['status' => TransactionStatus::COMPLETED]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
        DB::commit();

        Log::info($ordersCount . ' orders was purchased via transaction session (' . $this->request['order_transaction_session'] . ').');

        return response()->json(true);
    }

    public function total()
    {
        return collect($this->request['orders'])->reduce(fn (?int $carry,  $order) =>  $carry + $order['subtotal'], 0);
    }
}
