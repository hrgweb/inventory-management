<?php

namespace Hrgweb\PosAndInventory\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\PosAndInventory\Models\Order;
use Hrgweb\PosAndInventory\Domain\Order\Data\OrderData;
use Hrgweb\PosAndInventory\Domain\Order\Services\OrderService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $transaction_session_no = $request->input('transaction_session_no');

            if (!$transaction_session_no) {
                throw new Exception('no transaction session no on this request.');
            }

            return OrderService::fetch($transaction_session_no);
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

    public function destroy(Request $request, int $id)
    {
        try {
            return OrderService::make(array_merge($request->all(), ['order_id' => $id]))->remove();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
