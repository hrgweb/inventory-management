<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\Transaction\Data\TransactionData;
use Hrgweb\SalesAndInventory\Domain\Transaction\Services\TransactionService;

class TransactionController extends Controller
{
    public function store(TransactionData $transaction)
    {
        try {
            return TransactionService::make($transaction->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
