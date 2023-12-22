<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\Order\Data\OrderData;
use Hrgweb\SalesAndInventory\Domain\Order\Services\OrderService;

class OrderController extends Controller
{
    public function index()
    {
        try {
            // return OrderTransactionService::generate();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(OrderData $order)
    {
        try {
            return OrderService::make($order->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
